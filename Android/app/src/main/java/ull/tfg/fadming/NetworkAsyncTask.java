/*
 * Clase para la implementación de tareas asíncronas usadas para la conexión con la base de datos.
 * @author: Eduardo Escobar Alberto
 * @version: 1.0 05/09/2017
 * Correo electrónico: eduescal13@gmail.com.
 * Asignatura: Trabajo de Fin de Grado.
 * Centro: Universidad de La Laguna.
 */

package ull.tfg.fadming;

import android.os.AsyncTask;

import java.io.BufferedInputStream;
import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.io.OutputStreamWriter;
import java.net.HttpURLConnection;
import java.net.URL;
import android.net.Uri;
import android.view.View;
import android.widget.ProgressBar;

import org.json.JSONException;

import java.util.ArrayList;

public class NetworkAsyncTask extends AsyncTask<ArrayList<String>, Void, ArrayList<String>> {

    // DECLARACIÓN DE CONSTANTES.
    final static int READ_TIME_OUT = 10000;
    final static int CONNECT_TIME_OUT = 15000;
    final static int NO_RESPUESTA = -1;
    final static int RESPUESTA_ESTADOS = 0;
    final static int RESPUESTA_ACTUAL = 1;

    // DECLARACIÓN DE VARIABLES.
    public AsyncResponse delegate = null;

    // DECLARACIÓN DE ATRIBUTOS.
    private ArrayList<String> nombresParametros;
    private String url;
    private ProgressBar progressBar;
    private int tipoRespuesta;

    /**
     * Constructor.
     * @param delegate Delegado de la clase AsyncResponse (Interfaz).
     */
    public NetworkAsyncTask(String url, ArrayList<String> nombresParametros, ProgressBar progressBar, AsyncResponse delegate) {
        this.url = url;
        this.nombresParametros = nombresParametros;
        this.progressBar = progressBar;
        tipoRespuesta = NO_RESPUESTA;
        this.delegate = delegate;
    }

    /**
     * Constructor.
     * @param delegate Delegado de la clase AsyncResponse (Interfaz).
     */
    public NetworkAsyncTask(String url, ArrayList<String> nombresParametros, ProgressBar progressBar, int tipoRespuesta, AsyncResponse delegate) {
        this.url = url;
        this.nombresParametros = nombresParametros;
        this.progressBar = progressBar;
        this.tipoRespuesta = tipoRespuesta;
        this.delegate = delegate;
    }

    /**
     * Constructor.
     * @param delegate Delegado de la clase AsyncResponse (Interfaz).
     */
    public NetworkAsyncTask(String url, ArrayList<String> nombresParametros, int tipoRespuesta, AsyncResponse delegate) {
        this.url = url;
        progressBar = null;
        this.nombresParametros = nombresParametros;
        this.tipoRespuesta = tipoRespuesta;
        this.delegate = delegate;
    }

    @Override
    protected void onPreExecute() {
        if (getProgressBar() != null) {
            getProgressBar().setVisibility(View.VISIBLE);
        }
    }

    @Override
    protected final ArrayList<String> doInBackground(ArrayList<String>... parametros) {
        ArrayList<String> resultado = new ArrayList<>();
        try {
            URL url = new URL(getUrl());
            HttpURLConnection conexion = (HttpURLConnection) url.openConnection(); // Abrimos la conexión HTTP.
            conexion.setReadTimeout(READ_TIME_OUT); // Tiempo máximo de espera en la lectura de datos.
            conexion.setConnectTimeout(CONNECT_TIME_OUT); // Tiempo máximo de conexión.
            conexion.setDoInput(true);
            if (getNombresParametros().size() > 0) { // Si existen parametros.
                conexion.setRequestMethod("POST"); // Indicamos el paso de parámetros mediante el método POST.
                conexion.setDoOutput(true);
                Uri.Builder builder = new Uri.Builder();
                for (int i = 0; i < getNombresParametros().size(); i++) {
                    builder.appendQueryParameter(getNombresParametros().get(i), parametros[0].get(i));
                }
                String datos = builder.build().getEncodedQuery(); // Obtenemos los parámetro en el formato correcto.
                OutputStream outputStream = conexion.getOutputStream();
                writeStream(datos, outputStream); // Escribimos el buffer de salido los parámetros con el formato.
            }
            InputStream inputStream = new BufferedInputStream(conexion.getInputStream());
            if (conexion.getResponseCode() == HttpURLConnection.HTTP_OK) { // Si se obtiene un respuesta en la conexión.
                resultado.add(0, readStream(inputStream)); // Almacenamos la respuesta obtenida.
            }
            conexion.connect();
        } catch (Exception e) {
            e.printStackTrace();
        }
        return resultado;
    }

    @Override
    protected void onPostExecute(ArrayList<String> resultado) {
        if (getProgressBar() != null) {
            if (getProgressBar().getId() == R.id.progress_bar_inicio) {
                getProgressBar().setVisibility(View.INVISIBLE);
            }
            else if (getProgressBar().getId() == R.id.progress_bar_codigo) {
                getProgressBar().setVisibility(View.GONE);
            }
        }
        try {
            delegate.finalizarProceso(resultado, getTipoRespuesta());
        } catch (JSONException e) {
            e.printStackTrace();
        }
    }

    public void writeStream(String datos, OutputStream outputStream) throws IOException {
        BufferedWriter writer = new BufferedWriter(new OutputStreamWriter(outputStream, "UTF-8"));
        writer.write(datos);
        writer.flush();
        writer.close();
        outputStream.close();
    }

    public String readStream(InputStream inputStream) throws IOException {
        BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(inputStream));
        return bufferedReader.readLine();
    }

    public ProgressBar getProgressBar() {
        return progressBar;
    }

    public void setProgressBar(ProgressBar progressBar) {
        this.progressBar = progressBar;
    }

    public ArrayList<String> getNombresParametros() {
        return nombresParametros;
    }

    public void setNombresParametros(ArrayList<String> nombresParametros) {
        this.nombresParametros = nombresParametros;
    }

    public String getUrl() {
        return url;
    }

    public void setUrl(String url) {
        this.url = url;
    }

    public int getTipoRespuesta() {
        return tipoRespuesta;
    }

    public void setTipoRespuesta(int tipoRespuesta) {
        this.tipoRespuesta = tipoRespuesta;
    }
}
