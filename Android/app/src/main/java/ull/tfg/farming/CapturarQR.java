package ull.tfg.farming;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.TypedValue;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.ImageButton;
import android.view.View;
import android.widget.ListAdapter;
import android.widget.ListView;
import android.widget.RelativeLayout;
import android.widget.TextView;
import android.widget.Toast;
import android.view.View.OnTouchListener;
import android.view.MotionEvent;

import org.json.JSONArray;
import org.json.JSONObject;

import java.util.ArrayList;

public class CapturarQR extends AppCompatActivity implements View.OnClickListener, AsyncResponse, View.OnTouchListener {

    // DECLARACIÓN DE CONSTANTES.
    final static String USUARIO_FALLO = "Farming";
    final static String ALMACENAMIENTO_PREFERENCIAS = "datos";
    final static String PARAMETRO_IDENTIFICADOR = "identificador";
    final static String PARAMETRO_USUARIO = "usuario";
    final static String PARAMETRO_PLANTA = "planta";
    final static String PARAMETRO_CODIGO = "codigo";
    final static String PARAMETRO_NOMBRE = "nombre";
    final static String ERROR_QR = "No ha escaneado un código QR";
    final static String ERROR_CONEXION = "Revise su conexión a la red";
    final static float TEXTO_BOTON_PULSADO = 18;
    final static float TEXTO_BOTON_NORMAL = 15;

    // DECLARACIÓN DE ATRIBUTOS.
    private TextView textViewUsuario;
    private ImageButton botonCerrarSesion;
    private ImageButton botonEscanearCodigo;
    private Button botonSiguienteEstado;
    private Button botonAnteriorEstado;
    private ListView listaEstados;
    private ListAdapter adapterListaEstados;
    private RelativeLayout layoutMensajeEscanear;
    private SharedPreferences preferencias;
    private SharedPreferences.Editor editorPreferencias;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_capturar_qr);
        preferencias = getSharedPreferences(ALMACENAMIENTO_PREFERENCIAS, Context.MODE_PRIVATE);
        editorPreferencias = preferencias.edit();
        asociarObjetos();
        asignarListerner();
        getTextViewUsuario().setText(getPreferencias().getString(PARAMETRO_USUARIO, USUARIO_FALLO));
    }

    /**
     * Método para asociar los objetos Java de la actividad a sus elementos XML.
     */
    public void asociarObjetos() {
        setTextViewUsuario((TextView) findViewById(R.id.text_usuario));
        setBotonCerrarSesion((ImageButton) findViewById(R.id.boton_cerrar_sesion));
        setBotonEscanearCodigo((ImageButton) findViewById(R.id.boton_escanear_codigo));
        setListaEstados((ListView) findViewById(R.id.lista_estados));
        setLayoutMensajeEscanear((RelativeLayout) findViewById(R.id.layout_mensaje_escanear));
        setBotonAnteriorEstado((Button) findViewById(R.id.boton_anterior_estado));
        setBotonSiguienteEstado((Button) findViewById(R.id.boton_siguiente_estado));
    }

    public void asignarListerner() {
        getBotonEscanearCodigo().setOnClickListener(CapturarQR.this);
        getBotonSiguienteEstado().setOnTouchListener(CapturarQR.this);
        getBotonAnteriorEstado().setOnTouchListener(CapturarQR.this);
        getBotonCerrarSesion().setOnTouchListener(CapturarQR.this);
    }

    @Override
    public void onClick(View view) {
        if (view.getId() == R.id.boton_escanear_codigo) {
            IntentIntegrator scanIntegrator = new IntentIntegrator(this); // Instanciamos el escaner de códigos QR.
            scanIntegrator.initiateScan(); // Lanzamos el escaner de códigos QR.
            getLayoutMensajeEscanear().setVisibility(View.GONE);
        }
    }

    @Override
    public boolean onTouch(View view, MotionEvent motionEvent) {
        if (view.getId() == R.id.boton_anterior_estado) {
            if (motionEvent.getAction() == MotionEvent.ACTION_DOWN) {
                getBotonAnteriorEstado().setTextSize(TypedValue.COMPLEX_UNIT_DIP, TEXTO_BOTON_PULSADO);
                return true;
            }
            if (motionEvent.getAction() == MotionEvent.ACTION_UP) {
                getBotonAnteriorEstado().setTextSize(TypedValue.COMPLEX_UNIT_DIP, TEXTO_BOTON_NORMAL);
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

    public void onActivityResult(int requestCode, int resultCode, Intent intent) {
        IntentResult scanningResult = IntentIntegrator.parseActivityResult(requestCode, resultCode, intent); // Parseamos el resultado.
        if (scanningResult.getContents() != null) { // Si el resultado no es nulo.
            String scanContent = scanningResult.getContents();
            obtenerEstadosPlanta(scanContent);
        }
        else {
            Toast.makeText(getApplicationContext(), ERROR_QR, Toast.LENGTH_LONG).show();
        }
    }

    public void obtenerEstadosPlanta(String identificador_planta) {
        ArrayList<String> nombresParametros = new ArrayList<>();
        ArrayList<String> parametros = new ArrayList<>();
        nombresParametros.add(0, PARAMETRO_PLANTA);
        parametros.add(0, identificador_planta);
        ConnectivityManager connMgr = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo networkInfo = connMgr.getActiveNetworkInfo();
        if (networkInfo != null && networkInfo.isConnected()) {
            new NetworkAsyncTask("http://172.20.10.2/GricApp/Servidor/obtener_estados.php", nombresParametros, this).execute(parametros);
        } else {
            Toast.makeText(getApplicationContext(), ERROR_CONEXION, Toast.LENGTH_LONG).show();
        }
    }

    public ArrayList<Estado> extraerDatosJSON(String resultado) {
        ArrayList<Estado> estados = null;
        try {
            estados = new ArrayList<>();
            Estado estadoAlmacenar = null;
            JSONArray resultadoJSONArray = new JSONArray(resultado);
            JSONObject JSONObject;
            for (int i = 0; i < resultadoJSONArray.length(); i++) {
                JSONObject = resultadoJSONArray.getJSONObject(i);
                estadoAlmacenar = new Estado(JSONObject.getInt(PARAMETRO_CODIGO), JSONObject.getString(PARAMETRO_NOMBRE));
                estados.add(i, estadoAlmacenar);
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
        return estados;
    }

    public void rellenarListEstados(ArrayList<Estado> estados) {
        setAdapterListaEstados(new ArrayAdapter<>(CapturarQR.this, android.R.layout.simple_list_item_1, estados));
        getListaEstados().setAdapter(getAdapterListaEstados());
    }

    public void iniciarVistaEstados() {
        getListaEstados().setVisibility(View.VISIBLE);
        getBotonAnteriorEstado().setVisibility(View.VISIBLE);
        getBotonSiguienteEstado().setVisibility(View.VISIBLE);
    }

    @Override
    public void finalizarProceso(ArrayList<String> salida) {
        ArrayList<Estado> estados = extraerDatosJSON(salida.get(0));
        iniciarVistaEstados();
        rellenarListEstados(estados);
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

    public ListView getListaEstados() {
        return listaEstados;
    }

    public void setListaEstados(ListView listaEstados) {
        this.listaEstados = listaEstados;
    }

    public ListAdapter getAdapterListaEstados() {
        return adapterListaEstados;
    }

    public void setAdapterListaEstados(ListAdapter adapterListaEstados) {
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
}
