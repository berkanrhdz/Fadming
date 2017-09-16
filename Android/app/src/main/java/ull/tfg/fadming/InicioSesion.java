/*
 * Clase para la implementación de la actividad InicioSesión.
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
import android.support.v7.app.AppCompatActivity;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ProgressBar;
import android.widget.Toast;

import java.io.IOException;
import java.util.ArrayList;

import org.json.JSONArray;
import org.json.JSONObject;

public class InicioSesion extends AppCompatActivity implements AsyncResponse, View.OnClickListener {

    // DECLARACIÓN DE CONSTANTES.
    final static int ERROR_LOGIN = -1;
    final static String ALMACENAMIENTO_PREFERENCIAS = "datos";
    final static String PARAMETRO_IDENTIFICADOR = "identificador";
    final static String PARAMETRO_USUARIO = "usuario";
    final static String PARAMETRO_CONTRASENA = "contrasena";
    final static String ERROR_INICIO = "Usuario o contraseña incorrectos";
    final static String ERROR_CONEXION = "Revise su conexión a la red";
    final static String ERROR_USUARIO = "Usuario obligatorio";
    final static String ERROR_CONTRASENA = "Contraseña obligatoria";

    // DECLARACIÓN DE ATRIBUTOS.
    private EditText inputUsuario;
    private EditText inputContrasena;
    private Button botonIniciarSesion;
    private ProgressBar progressBarInicio;
    private SharedPreferences preferencias;
    private SharedPreferences.Editor editorPreferencias;

    /**
     * Método onCreate de la actividad. Iniciado en la creación de InicioSesion.
     */
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_inicio_sesion);
        preferencias = getSharedPreferences(ALMACENAMIENTO_PREFERENCIAS, Context.MODE_PRIVATE);
        editorPreferencias = preferencias.edit();
        asociarObjetos();
        progressBarInicio.setVisibility(View.INVISIBLE);
        asignarListener();
    }

    /**
     * Método para asociar los objetos Java de la actividad a sus elementos XML.
     */
    public void asociarObjetos() {
        setInputUsuario((EditText) findViewById(R.id.input_usuario));
        setInputContrasena((EditText) findViewById(R.id.input_contrasena));
        setBotonIniciarSesion((Button) findViewById(R.id.boton_iniciar_sesion));
        setProgressBarInicio((ProgressBar) findViewById(R.id.progress_bar_inicio));
    }

    public void asignarListener() {
        getBotonIniciarSesion().setOnClickListener(InicioSesion.this);
    }

    /**
     * Sobreescritura del método onClick para controlar las pulsaciones en los elementos de la actividad
     * @param view Parámetro view con el elemento que realiza el evento.
     */
    @Override
    public void onClick(View view) {
        if (view.getId() == R.id.boton_iniciar_sesion) {
            String usuario    = getInputUsuario().getText().toString();
            String contrasena = getInputContrasena().getText().toString();
            if (usuario.isEmpty()) {
                Toast.makeText(getApplicationContext(), ERROR_USUARIO, Toast.LENGTH_LONG).show();
            }
            else if (contrasena.isEmpty()) {
                Toast.makeText(getApplicationContext(), ERROR_CONTRASENA, Toast.LENGTH_LONG).show();
            }
            else {
                try {
                    obtenerIdentificadorUsuario(usuario, contrasena);
                } catch (IOException e) {
                    e.printStackTrace();
                }
            }
        }
    }

    /**
     * Método para validar los datos de inicio introducidos por el usuario.
     * @param usuario Nombre del usuario que inicia sesión.
     * @param contrasena Contraseña del usuario que inicia sesión.
     */
    public void obtenerIdentificadorUsuario(String usuario, String contrasena) throws IOException {
        ArrayList<String> nombresParametros = new ArrayList<>();
        ArrayList<String> parametros = new ArrayList<>();
        nombresParametros.add(0, PARAMETRO_USUARIO);
        nombresParametros.add(1, PARAMETRO_CONTRASENA);
        parametros.add(0, usuario);
        parametros.add(1, contrasena);
        ConnectivityManager connMgr = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo networkInfo = connMgr.getActiveNetworkInfo();
        if (networkInfo != null && networkInfo.isConnected()) {
            new NetworkAsyncTask("http://192.168.1.41/Fadming/Servidor/iniciar_sesion.php", nombresParametros, getProgressBarInicio(), this).execute(parametros);
        } else {
            Toast.makeText(getApplicationContext(), ERROR_CONEXION, Toast.LENGTH_LONG).show();
        }
    }

    /**
     * Función que parsea y comprueba la respuesta obtenida desde el servidor.
     * @param resultado Resultado obtenido desde el servidor.
     * @return Identificador del usuario parseado.
     */
    public int extraerDatosJSON(String resultado) {
        int valorRespuesta = 0;
        try {
            JSONArray resultadoJSONArray   = new JSONArray(resultado);
            JSONObject resultadoJSONObject = resultadoJSONArray.getJSONObject(0);
            valorRespuesta = resultadoJSONObject.getInt(PARAMETRO_IDENTIFICADOR);
        } catch (Exception e) {
            e.printStackTrace();
        }
        return valorRespuesta;
    }

    @Override
    public void finalizarProceso(ArrayList<String> salida, int tipoRespuesta) {
        int identificador = extraerDatosJSON(salida.get(0));
        if (identificador != ERROR_LOGIN) {
            getEditorPreferencias().putInt(PARAMETRO_IDENTIFICADOR, identificador);
            getEditorPreferencias().putString(PARAMETRO_USUARIO, getInputUsuario().getText().toString());
            getEditorPreferencias().commit();
            Intent capturarQR = new Intent(getApplicationContext(), CapturarQR.class);
            startActivity(capturarQR);
        } else {
            Toast.makeText(getApplicationContext(), ERROR_INICIO, Toast.LENGTH_LONG).show();
        }
    }

    public EditText getInputUsuario() {
        return inputUsuario;
    }

    public void setInputUsuario(EditText inputUsuario) {
        this.inputUsuario = inputUsuario;
    }

    public EditText getInputContrasena() {
        return inputContrasena;
    }

    public void setInputContrasena(EditText inputContrasena) {
        this.inputContrasena = inputContrasena;
    }

    public Button getBotonIniciarSesion() {
        return botonIniciarSesion;
    }

    public void setBotonIniciarSesion(Button botonIniciarSesion) {
        this.botonIniciarSesion = botonIniciarSesion;
    }

    public ProgressBar getProgressBarInicio() {
        return progressBarInicio;
    }

    public void setProgressBarInicio(ProgressBar progressBarInicio) {
        this.progressBarInicio = progressBarInicio;
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



