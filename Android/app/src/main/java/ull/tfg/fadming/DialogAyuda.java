/*
 * Clase para la implementación de un dialog que muestre una ayuda al usuario.
 * @author: Eduardo Escobar Alberto
 * @version: 1.0 05/09/2017
 * Correo electrónico: eduescal13@gmail.com.
 * Asignatura: Trabajo de Fin de Grado.
 * Centro: Universidad de La Laguna.
 */

package ull.tfg.fadming;

import android.app.AlertDialog;
import android.app.Dialog;
import android.app.DialogFragment;
import android.content.Context;
import android.content.DialogInterface;
import android.os.Bundle;

public class DialogAyuda extends DialogFragment {

    private Context actividad;

    public DialogAyuda(Context actividad) {
        this.actividad = actividad;
    }

    /**
     * Sobreescritura de la función onCreateDialog para modificar el comportamiento por defecto.
     * @param savedInstanceState Parámetro que contiene datos desde la actividad anterior.
     * @return Creación del alert dialog.
     */
    @Override
    public Dialog onCreateDialog(Bundle savedInstanceState) {
        AlertDialog.Builder builder = new AlertDialog.Builder(getActividad());
        builder.setTitle("Ayuda");
        builder.setMessage("Esto es una ayuda");
        builder.setPositiveButton("OK", new DialogInterface.OnClickListener() {
            public void onClick(DialogInterface dialog, int id) {
                dialog.cancel();
            }
        });
        return builder.create();
    }

    public Context getActividad() {
        return actividad;
    }

    public void setActividad(Context actividad) {
        this.actividad = actividad;
    }
}
