/*
 * Clase interface para acceder a la respuesta del servidor en la clase NetworkAsyncTask.
 * @author: Eduardo Escobar Alberto
 * @version: 1.0 05/09/2017
 * Correo electrónico: eduescal13@gmail.com.
 * Asignatura: Trabajo de Fin de Grado.
 * Centro: Universidad de La Laguna.
 */

package ull.tfg.fadming;

import org.json.JSONException;

import java.util.ArrayList;

public interface AsyncResponse {
    void finalizarProceso(ArrayList<String> salida, int tipoRespuesta) throws JSONException;
}
