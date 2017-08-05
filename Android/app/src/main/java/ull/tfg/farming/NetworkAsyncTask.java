package ull.tfg.farming;

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

import java.util.ArrayList;

public class NetworkAsyncTask extends AsyncTask<ArrayList<String>, Void, ArrayList<String>> {

    // DECLARACIÓN DE CONSTANTES.
    final static int READ_TIME_OUT = 10000;
    final static int CONNECT_TIME_OUT = 15000;

    // DECLARACIÓN DE VARIABLES.
    public AsyncResponse delegate = null;

    // DECLARACIÓN DE ATRIBUTOS.
    private ArrayList<String> nombresParametros;
    private String url;
    private ProgressBar progressBar;

    /**
     * Constructor.
     * @param delegate Delegado de la clase AsyncResponse (Interfaz).
     */
    public NetworkAsyncTask(String url, ArrayList<String> nombresParametros, ProgressBar progressBar, AsyncResponse delegate) {
        this.url = url;
        this.nombresParametros = nombresParametros;
        this.progressBar = progressBar;
        this.delegate = delegate;
    }

    /**
     * Constructor.
     * @param delegate Delegado de la clase AsyncResponse (Interfaz).
     */
    public NetworkAsyncTask(String url, ArrayList<String> nombresParametros, AsyncResponse delegate) {
        this.url = url;
        progressBar = null;
        this.nombresParametros = nombresParametros;
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
            HttpURLConnection conexion = (HttpURLConnection) url.openConnection();
            conexion.setReadTimeout(READ_TIME_OUT);
            conexion.setConnectTimeout(CONNECT_TIME_OUT);
            conexion.setDoInput(true);
            if (getNombresParametros().size() > 0) { // Si existen parametros.
                conexion.setRequestMethod("POST");
                conexion.setDoOutput(true); // Activamos el método POST.
                Uri.Builder builder = new Uri.Builder();
                for (int i = 0; i < getNombresParametros().size(); i++) {
                    builder.appendQueryParameter(getNombresParametros().get(i), parametros[0].get(i));
                }
                String datos = builder.build().getEncodedQuery();
                OutputStream outputStream = conexion.getOutputStream();
                writeStream(datos, outputStream);
            }
            InputStream inputStream = new BufferedInputStream(conexion.getInputStream());
            if (conexion.getResponseCode() == HttpURLConnection.HTTP_OK) {
                resultado.add(0, readStream(inputStream));
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
            getProgressBar().setVisibility(View.INVISIBLE);
        }
        delegate.finalizarProceso(resultado);
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
}
