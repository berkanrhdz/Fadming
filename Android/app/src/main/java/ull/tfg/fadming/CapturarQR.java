/*
 * Clase para la implementación de la actividad CapturarQR.
 * @author: Eduardo Escobar Alberto
 * @version: 1.0 05/09/2017
 * Correo electrónico: eduescal13@gmail.com.
 * Asignatura: Trabajo de Fin de Grado.
 * Centro: Universidad de La Laguna.
 */

package ull.tfg.fadming;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.TypedValue;
import android.view.View;
import android.widget.AdapterView;
import android.widget.Button;
import android.widget.ExpandableListView;
import android.widget.ImageButton;
import android.widget.ProgressBar;
import android.widget.RelativeLayout;
import android.widget.TextView;
import android.widget.Toast;
import android.view.MotionEvent;

import org.json.JSONArray;
import org.json.JSONObject;

import java.util.ArrayList;

public class CapturarQR extends AppCompatActivity implements View.OnClickListener, AsyncResponse, View.OnTouchListener, AdapterView.OnItemLongClickListener {

    // DECLARACIÓN DE VARIABLES.
    int posicionEstado = 0;

    // DECLARACIÓN DE CONSTANTES.
    final static String USUARIO_FALLO = "fadming";
    final static String ALMACENAMIENTO_PREFERENCIAS = "datos";
    final static String PARAMETRO_IDENTIFICADOR = "identificador";
    final static String PARAMETRO_USUARIO = "usuario";
    final static String PARAMETRO_PLANTA = "planta";
    final static String PARAMETRO_CODIGO = "codigo";
    final static String PARAMETRO_NOMBRE = "nombre";
    final static String PARAMETRO_ACTUAL = "actual";
    final static String PARAMETRO_DESCRIPCION = "descripcion";
    final static String ERROR_QR = "No ha escaneado un código QR";
    final static String ERROR_NO_VALIDO = "El código QR no es válido";
    final static String ENTEROS_POSITIVOS = "^[0-9]+$";
    final static String ERROR_CONEXION = "Revise su conexión a la red";
    final static int ERROR_ACTUAL = -1;
    final static float TEXTO_BOTON_PULSADO = 18;
    final static float TEXTO_BOTON_NORMAL = 15;
    final static int ANTERIOR_ESTADO = -1;
    final static int SIGUIENTE_ESTADO = 1;

    // DECLARACIÓN DE ATRIBUTOS.
    private TextView textViewUsuario;
    private ImageButton botonCerrarSesion;
    private ImageButton botonEscanearCodigo;
    private Button botonSiguienteEstado;
    private Button botonAnteriorEstado;
    private ExpandableListView listaEstados;
    private EstadosAdapter adapterListaEstados;
    private RelativeLayout layoutMensajeEscanear;
    private SharedPreferences preferencias;
    private SharedPreferences.Editor editorPreferencias;
    private ProgressBar progressBarCapturar;
    private int identificadorPlanta;
    private ArrayList<Estado> estados;
    private int estadoActual;

    /**
     * Sobreescritura del método onCreate de la actividad.
     * @param savedInstanceState Paramétro usado para obtener los datos desde la actividad anterior.
     */
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_capturar_qr); // Carga del layout de la actividad.
        preferencias = getSharedPreferences(ALMACENAMIENTO_PREFERENCIAS, Context.MODE_PRIVATE);
        estados = new ArrayList<>();
        identificadorPlanta = 0;
        editorPreferencias = preferencias.edit();
        asociarObjetos();
        progressBarCapturar.setVisibility(View.GONE); // Inicialmente, la progressBar no se muestra en la pantalla.
        asignarListerner();
        getTextViewUsuario().setText(getPreferencias().getString(PARAMETRO_USUARIO, USUARIO_FALLO)); // Obtenemos el usuario desde preferencias.
        editorPreferencias.apply();
    }

    /**
     * Método para asociar los objetos Java de la actividad a sus elementos XML.
     */
    public void asociarObjetos() {
        setTextViewUsuario((TextView) findViewById(R.id.text_usuario));
        setBotonCerrarSesion((ImageButton) findViewById(R.id.boton_cerrar_sesion));
        setBotonEscanearCodigo((ImageButton) findViewById(R.id.boton_escanear_codigo));
        setListaEstados((ExpandableListView) findViewById(R.id.lista_estados));
        setLayoutMensajeEscanear((RelativeLayout) findViewById(R.id.layout_mensaje_escanear));
        setBotonAnteriorEstado((Button) findViewById(R.id.boton_anterior_estado));
        setBotonSiguienteEstado((Button) findViewById(R.id.boton_siguiente_estado));
        setProgressBarCapturar((ProgressBar) findViewById(R.id.progress_bar_codigo));
    }

    /**
     * Método para asignar los listener a los elementos que lo requieran.
     */
    public void asignarListerner() {
        getBotonEscanearCodigo().setOnClickListener(CapturarQR.this);
        getBotonSiguienteEstado().setOnTouchListener(CapturarQR.this);
        getBotonAnteriorEstado().setOnTouchListener(CapturarQR.this);
        getBotonCerrarSesion().setOnTouchListener(CapturarQR.this);
        getListaEstados().setOnItemLongClickListener(CapturarQR.this);
    }

    /**
     * Sobreescritura del método onClick para controlar las pulsaciones en los elementos de la actividad
     * @param view Parámetro view con el elemento que realiza el evento.
     */
    @Override
    public void onClick(View view) {
        if (view.getId() == R.id.boton_escanear_codigo) {
            IntentIntegrator scanIntegrator = new IntentIntegrator(this); // Instanciamos el escaner de códigos QR.
            scanIntegrator.initiateScan(); // Lanzamos el escaner de códigos QR.
            getLayoutMensajeEscanear().setVisibility(View.GONE);
        }
    }

    /**
     * Sobreescritura de la función onTouch para controlar las presiones en los elementos de la actividad.
     * @param view Parámetro view con el elemento que realiza el evento.
     * @param motionEvent Tipo de evento realizado dentro de onTouch.
     * @return True si se produce alguno de los eventos.
     */
    @Override
    public boolean onTouch(View view, MotionEvent motionEvent) {
        if (view.getId() == R.id.boton_anterior_estado) {
            if (motionEvent.getAction() == MotionEvent.ACTION_DOWN) {
                getBotonAnteriorEstado().setTextSize(TypedValue.COMPLEX_UNIT_DIP, TEXTO_BOTON_PULSADO);
                return true;
            }
            if (motionEvent.getAction() == MotionEvent.ACTION_UP) {
                getBotonAnteriorEstado().setTextSize(TypedValue.COMPLEX_UNIT_DIP, TEXTO_BOTON_NORMAL);
                estadoAnteriorSiguiente(ANTERIOR_ESTADO);
                return true;
            }
        }
        if (view.getId() == R.id.boton_siguiente_estado) {
            if (motionEvent.getAction() == MotionEvent.ACTION_DOWN) {
                getBotonSiguienteEstado().setTextSize(TypedValue.COMPLEX_UNIT_DIP, TEXTO_BOTON_PULSADO);
                return true;
            }
            if (motionEvent.getAction() == MotionEvent.ACTION_UP) {
                getBotonSiguienteEstado().setTextSize(TypedValue.COMPLEX_UNIT_DIP, TEXTO_BOTON_NORMAL);
                estadoAnteriorSiguiente(SIGUIENTE_ESTADO);
                return true;
            }
        }
        if (view.getId() == R.id.boton_cerrar_sesion) {
            if (motionEvent.getAction() == MotionEvent.ACTION_DOWN) {
                getBotonCerrarSesion().setImageResource(R.drawable.cerrar_sesion_negro);
                return true;
            }
            if (motionEvent.getAction() == MotionEvent.ACTION_UP) {
                getBotonCerrarSesion().setImageResource(R.drawable.cerrar_sesion_blanco);
                getEditorPreferencias().remove(PARAMETRO_IDENTIFICADOR); // Eliminamos del almacenamiento local el identificador del usuario.
                getEditorPreferencias().remove(PARAMETRO_USUARIO); // Eliminamos del almacenamiento local el nombre del usuario.
                finish(); // Finalizamos la aplicación y regresamos a la actividad principal.
                return true;
            }
        }
        return false;
    }

    /**
     * Sobreescritura de la función onItemLongClick para controlar las presiones largas en el ExpandableListView.
     * @param adapterView Parámetro de tipo AdapterView.
     * @param view Parámetro view con el elemento que realiza el evento.
     * @param posicion Posición del item presionado.
     * @param id Identificador del item presionado.
     * @return True si se realiza el evento.
     */
    @Override
    public boolean onItemLongClick(AdapterView<?> adapterView, View view, int posicion, long id) {
        int tipoItem = ExpandableListView.getPackedPositionType(id);
        if (tipoItem == ExpandableListView.PACKED_POSITION_TYPE_GROUP) {
            posicionEstado = ExpandableListView.getPackedPositionGroup(id);
            int codigoEstado = obtenerCodigo(posicionEstado);
            actualizarEstadoActual(getIdentificadorPlanta(), codigoEstado);
            return true;
        }
        return false;
    }

    /**
     * Método para obtener el resultado del códigoQR capturado.
     * @param requestCode Código de la solicitud realizada.
     * @param resultCode Código de la respuesta del escaner de QR.
     * @param intent Parámetro de tipo Intent.
     */
    public void onActivityResult(int requestCode, int resultCode, Intent intent) {
        IntentResult scanningResult = IntentIntegrator.parseActivityResult(requestCode, resultCode, intent); // Parseamos el resultado.
        if (scanningResult.getContents() != null) { // Si el resultado no es nulo.
            String scanContent = scanningResult.getContents(); // Lo almacenamos en un String.
            System.out.println(scanContent.matches(ENTEROS_POSITIVOS));
            if (scanContent.matches(ENTEROS_POSITIVOS)) {
                setIdentificadorPlanta(Integer.parseInt(scanContent)); // Lo parseamos a un entero y lo almacenamos.
                obtenerEstadosPlanta();
            }
            else { // Si no se escanea ningún código.
                Toast.makeText(getApplicationContext(), ERROR_NO_VALIDO, Toast.LENGTH_LONG).show(); // Mostramos un mensaje de error.
            }
        }
        else { // Si no se escanea ningún código.
            Toast.makeText(getApplicationContext(), ERROR_QR, Toast.LENGTH_LONG).show(); // Mostramos un mensaje de error.
        }
    }

    /**
     * Método que obtiene, desde la base de datos, todos los estados de la planta del código analizado.
     */
    public void obtenerEstadosPlanta() {
        ArrayList<String> nombresParametros = new ArrayList<>();
        ArrayList<String> parametros = new ArrayList<>();
        nombresParametros.add(0, PARAMETRO_PLANTA);
        parametros.add(0, getIdentificadorPlanta() + "");
        ConnectivityManager connMgr = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo networkInfo = connMgr.getActiveNetworkInfo();
        if (networkInfo != null && networkInfo.isConnected()) {
            new NetworkAsyncTask("http://192.168.1.39/Fadming/Servidor/obtener_estados.php", nombresParametros, getProgressBarCapturar(), NetworkAsyncTask.RESPUESTA_ESTADOS, this).execute(parametros);
        } else {
            Toast.makeText(getApplicationContext(), ERROR_CONEXION, Toast.LENGTH_LONG).show();
        }
    }

    /**
     * Función que extrae los datos de un String en formato de objeto JSON.
     * @param datosJSON String con los datos en formato JSON.
     * @return ArrayList con los estados almacenados.
     */
    public ArrayList<Estado> extraerDatosJSON(String datosJSON) {
        ArrayList<Estado> estados = null;
        try {
            estados = new ArrayList<>();
            Estado estadoAlmacenar;
            JSONArray resultadoJSONArray = new JSONArray(datosJSON); // Convertimos el String en el JSONArray.
            JSONObject JSONObject;
            for (int i = 0; i < resultadoJSONArray.length(); i++) { // Extraemos los datos y los almacenamos en el ArrayList.
                JSONObject = resultadoJSONArray.getJSONObject(i);
                estadoAlmacenar = new Estado(JSONObject.getInt(PARAMETRO_CODIGO), JSONObject.getString(PARAMETRO_NOMBRE), JSONObject.getString(PARAMETRO_DESCRIPCION), JSONObject.getBoolean(PARAMETRO_ACTUAL));
                estados.add(i, estadoAlmacenar);
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
        return estados;
    }

    /**
     * Método para rellenar el ExpandableListView con los estados correspondientes.
     */
    public void rellenarListEstados() {
        ArrayList<String> nombre = new ArrayList<>();
        ArrayList<ArrayList<String>> descripcion = new ArrayList<>();
        for (int i = 0; i < getEstados().size(); i++) {
            nombre.add(i, getEstados().get(i).getNombre());
            descripcion.add(i, new ArrayList<String>());
            descripcion.get(i).add(0, getEstados().get(i).getDescripcion());
            if (getEstados().get(i).isActual()) {
                setEstadoActual(i);
            }
        }
        setAdapterListaEstados(new EstadosAdapter(CapturarQR.this, nombre, descripcion, getEstadoActual()));
        getListaEstados().setAdapter(getAdapterListaEstados());
    }

    /**
     * Método que realiza el cambio en la vista de la actividad CapturarQR una vez que se analiza el código.
     */
    public void iniciarVistaEstados() {
        getListaEstados().setVisibility(View.VISIBLE);
        getBotonAnteriorEstado().setVisibility(View.VISIBLE);
        getBotonSiguienteEstado().setVisibility(View.VISIBLE);
    }

    /**
     * Función que devuelve el código de un estado a partir de la posición del item en la ExpandableListView.
     * @param posicionEstado Posición del item en la ExpandableListView.
     * @return Código del estado.
     */
    public int obtenerCodigo(int posicionEstado) {
        return getEstados().get(posicionEstado).getCodigo();
    }

    /**
     * Método que actualiza el estado actual de la planta dentro de la base de datos.
     * @param identificadorPlanta Identificador de la planta a actualizar.
     * @param nuevoEstadoActual Nuevo estado actual de la planta.
     */
    public void actualizarEstadoActual(int identificadorPlanta, int nuevoEstadoActual) {
        ArrayList<String> nombresParametros = new ArrayList<>();
        ArrayList<String> parametros = new ArrayList<>();
        nombresParametros.add(0, PARAMETRO_PLANTA);
        nombresParametros.add(1, PARAMETRO_ACTUAL);
        parametros.add(0, identificadorPlanta + "");
        parametros.add(1, nuevoEstadoActual + "");
        ConnectivityManager connMgr = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo networkInfo = connMgr.getActiveNetworkInfo();
        if (networkInfo != null && networkInfo.isConnected()) {
            new NetworkAsyncTask("http://192.168.1.39/Fadming/Servidor/actualizar_estado_actual.php", nombresParametros, NetworkAsyncTask.RESPUESTA_ACTUAL, this).execute(parametros);
        } else {
            Toast.makeText(getApplicationContext(), ERROR_CONEXION, Toast.LENGTH_LONG).show();
        }
    }

    /**
     * Método que cambia gráficamente los colores del estado actual anterior y del nuevo.
     * @param anteriorEstado Anterior estado de la planta.
     * @param nuevoEstado Nuevo estado de la planta.
     */
    public void cambiarColorEstado(int anteriorEstado, int nuevoEstado) {
        getListaEstados().getChildAt(anteriorEstado).setBackgroundResource(R.color.grisOscuro);
        getListaEstados().getChildAt(nuevoEstado).setBackgroundResource(R.color.rojoGranate);
        getAdapterListaEstados().setEstadoActual(nuevoEstado);
        getEstados().get(anteriorEstado).setActual(false);
        getEstados().get(nuevoEstado).setActual(true);
        getAdapterListaEstados().notifyDataSetChanged(); // Notificamos al Adapter los cambios de sus atributos.
    }

    /**
     * Método que realiza el cambia de estados cuando se usan los botones de anterior y siguiente de la actividad.
     * @param movimiento Tipo de movimiento realizado (anterior y siguiente).
     */
    public void estadoAnteriorSiguiente(int movimiento) {
        int codigoNuevo;
        if ((posicionEstado == (getEstados().size() - 1)) && (movimiento == SIGUIENTE_ESTADO)) {
            posicionEstado = 0;
            codigoNuevo = getEstados().get(posicionEstado).getCodigo();
        }
        else if ((posicionEstado == 0) && (movimiento == ANTERIOR_ESTADO)) {
            posicionEstado = getEstados().size() - 1;
            codigoNuevo = getEstados().get(posicionEstado).getCodigo();
        }
        else {
            posicionEstado  = getEstadoActual() + movimiento;
            codigoNuevo = getEstados().get(posicionEstado).getCodigo();
        }
        actualizarEstadoActual(getIdentificadorPlanta(), codigoNuevo);
    }

    /**
     * Sobreescritura del método (interface) para obtener las respuestas de las conexiones con la base de datos.
     * @param salida Salida en formato ArrayList<String> con la respuesta del servidor.
     * @param tipoRespuesta Tipo de respuesta del servidor.
     */
    @Override
    public void finalizarProceso(ArrayList<String> salida, int tipoRespuesta) {
        switch (tipoRespuesta) {
            case NetworkAsyncTask.RESPUESTA_ESTADOS: // Si es una respuesta de una consulta de obtención de estados.
                setEstados(extraerDatosJSON(salida.get(0)));
                iniciarVistaEstados();
                rellenarListEstados(); // Rellenamos el ExpandableListView con los estados.
            break;
            case NetworkAsyncTask.RESPUESTA_ACTUAL: // Si es una respuesta de una consulta del estado actual.
                int respuesta = Integer.parseInt(salida.get(0).charAt(1) + "");
                if (respuesta != ERROR_ACTUAL) { // Si no se produjo un error en la actualización del estado actual.
                    cambiarColorEstado(getEstadoActual(), posicionEstado); // Realizamos el cambio gráfico.
                    setEstadoActual(posicionEstado);
                }
            break;
        }
    }

    public TextView getTextViewUsuario() {
        return textViewUsuario;
    }

    public void setTextViewUsuario(TextView textViewUsuario) {
        this.textViewUsuario = textViewUsuario;
    }

    public ImageButton getBotonCerrarSesion() {
        return botonCerrarSesion;
    }

    public void setBotonCerrarSesion(ImageButton botonCerrarSesion) {
        this.botonCerrarSesion = botonCerrarSesion;
    }

    public ImageButton getBotonEscanearCodigo() {
        return botonEscanearCodigo;
    }

    public void setBotonEscanearCodigo(ImageButton botonEscanearCodigo) {
        this.botonEscanearCodigo = botonEscanearCodigo;
    }

    public Button getBotonSiguienteEstado() {
        return botonSiguienteEstado;
    }

    public void setBotonSiguienteEstado(Button botonSiguienteEstado) {
        this.botonSiguienteEstado = botonSiguienteEstado;
    }

    public Button getBotonAnteriorEstado() {
        return botonAnteriorEstado;
    }

    public void setBotonAnteriorEstado(Button botonAnteriorEstado) {
        this.botonAnteriorEstado = botonAnteriorEstado;
    }

    public ExpandableListView getListaEstados() {
        return listaEstados;
    }

    public void setListaEstados(ExpandableListView listaEstados) {
        this.listaEstados = listaEstados;
    }

    public EstadosAdapter getAdapterListaEstados() {
        return adapterListaEstados;
    }

    public void setAdapterListaEstados(EstadosAdapter adapterListaEstados) {
        this.adapterListaEstados = adapterListaEstados;
    }

    public RelativeLayout getLayoutMensajeEscanear() {
        return layoutMensajeEscanear;
    }

    public void setLayoutMensajeEscanear(RelativeLayout layoutMensajeEscanear) {
        this.layoutMensajeEscanear = layoutMensajeEscanear;
    }

    public SharedPreferences getPreferencias() {
        return preferencias;
    }

    public void setPreferencias(SharedPreferences preferencias) {
        this.preferencias = preferencias;
    }

    public SharedPreferences.Editor getEditorPreferencias() {
        return editorPreferencias;
    }

    public void setEditorPreferencias(SharedPreferences.Editor editorPreferencias) {
        this.editorPreferencias = editorPreferencias;
    }

    public ProgressBar getProgressBarCapturar() {
        return progressBarCapturar;
    }

    public void setProgressBarCapturar(ProgressBar progressBarCapturar) {
        this.progressBarCapturar = progressBarCapturar;
    }

    public ArrayList<Estado> getEstados() {
        return estados;
    }

    public void setEstados(ArrayList<Estado> estados) {
        this.estados = estados;
    }

    public int getIdentificadorPlanta() {
        return identificadorPlanta;
    }

    public void setIdentificadorPlanta(int identificadorPlanta) {
        this.identificadorPlanta = identificadorPlanta;
    }

    public int getEstadoActual() {
        return estadoActual;
    }

    public void setEstadoActual(int estadoActual) {
        this.estadoActual = estadoActual;
    }
}
