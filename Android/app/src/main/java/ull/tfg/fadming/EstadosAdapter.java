/*
 * Clase para la implementación de un adapter para la ExpandableListView. Extiende de BaseExpandableListView.
 * @author: Eduardo Escobar Alberto
 * @version: 1.0 05/09/2017
 * Correo electrónico: eduescal13@gmail.com.
 * Asignatura: Trabajo de Fin de Grado.
 * Centro: Universidad de La Laguna.
 */

package ull.tfg.fadming;

import android.content.Context;
import android.graphics.Color;
import android.graphics.Typeface;
import android.util.TypedValue;
import android.view.Gravity;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AbsListView;
import android.widget.BaseExpandableListAdapter;
import android.widget.TextView;

import java.util.ArrayList;

public class EstadosAdapter extends BaseExpandableListAdapter {

    // DECLARACIÓN DE CONSTANTES.
    final static int PADDING_LEFT_TEXTO = 50;
    final static int PADDING_LATERAL_TEXTO = 20;
    final static float TAMANO_TEXTO_ESTADO = 16;
    final static float TAMANO_TEXTO_DESCRIPCION = 15;
    final static int TEXTVIEW_NOMBRE = 0;
    final static int TEXTVIEW_DESCRIPCION = 1;
    final static int TEXTVIEW_ACTUAL = 2;

    // DECLARACIÓN DE ATRIBUTOS.
    private ArrayList<String> nombre;
    private ArrayList<ArrayList<String>> descripcion;
    private int estadoActual;
    private Context context;

    public EstadosAdapter(Context context, ArrayList<String> nombre, ArrayList<ArrayList<String>> descripcion, int estadoActual) {
        this.context = context;
        this.nombre = nombre;
        this.descripcion = descripcion;
        this.estadoActual = estadoActual;
    }

    public Object getChild(int groupPosition, int childPosition) {
        return getDescripcion().get(groupPosition).get(childPosition);
    }

    public long getChildId(int groupPosition, int childPosition) {
        return childPosition;
    }

    public int getChildrenCount(int groupPosition) {
        int i = 0;
        try {
            i = getDescripcion().get(groupPosition).size();
        } catch (Exception e) {
            e.printStackTrace();
        }
        return i;
    }

    /**
     * Método para generar los TextView que serán cada uno de los item de la ExpandableListView.
     * @param tipo Tipo de TextView a crear.
     * @return TextView con formato.
     */
    public TextView getGenericView(int tipo) {
        AbsListView.LayoutParams params = new AbsListView.LayoutParams(ViewGroup.LayoutParams.MATCH_PARENT, ViewGroup.LayoutParams.WRAP_CONTENT);
        TextView textView = new TextView(getContext());
        textView.setLayoutParams(params);
        textView.setGravity(Gravity.CENTER_VERTICAL | Gravity.LEFT);
        if (tipo == TEXTVIEW_NOMBRE) {
            textView.setBackgroundResource(R.color.grisOscuro);
            textView.setTextColor(Color.WHITE);
            textView.setPadding(PADDING_LEFT_TEXTO, PADDING_LATERAL_TEXTO, PADDING_LATERAL_TEXTO, PADDING_LATERAL_TEXTO);
            textView.setTypeface(Typeface.SANS_SERIF, Typeface.BOLD);
            textView.setTextSize(TypedValue.COMPLEX_UNIT_DIP, TAMANO_TEXTO_ESTADO);
        }
        else if (tipo == TEXTVIEW_DESCRIPCION) {
            textView.setTextColor(Color.BLACK);
            textView.setPadding(PADDING_LATERAL_TEXTO, PADDING_LATERAL_TEXTO, PADDING_LATERAL_TEXTO, PADDING_LATERAL_TEXTO);
            textView.setBackgroundResource(R.color.grisClaroDescripcion);
            textView.setTypeface(Typeface.SANS_SERIF);
            textView.setTextSize(TypedValue.COMPLEX_UNIT_DIP, TAMANO_TEXTO_DESCRIPCION);
            textView.setTextAlignment(View.TEXT_ALIGNMENT_CENTER);
        }
        else if (tipo == TEXTVIEW_ACTUAL) {
            textView.setBackgroundResource(R.color.rojoGranate);
            textView.setTextColor(Color.WHITE);
            textView.setPadding(PADDING_LEFT_TEXTO, PADDING_LATERAL_TEXTO, PADDING_LATERAL_TEXTO, PADDING_LATERAL_TEXTO);
            textView.setTypeface(Typeface.SANS_SERIF, Typeface.BOLD);
            textView.setTextSize(TypedValue.COMPLEX_UNIT_DIP, TAMANO_TEXTO_ESTADO);
        }
        return textView;
    }

    public View getChildView(int groupPosition, int childPosition, boolean isLastChild, View convertView, ViewGroup parent) {
        TextView textView = getGenericView(TEXTVIEW_DESCRIPCION);
        textView.setText(getChild(groupPosition, childPosition).toString());
        return textView;
    }

    public Object getGroup(int groupPosition) {
        return getNombre().get(groupPosition);
    }

    public int getGroupCount() {
        return getNombre().size();
    }

    public long getGroupId(int groupPosition) {
        return groupPosition;
    }

    public View getGroupView(int groupPosition, boolean isExpanded, View convertView, ViewGroup parent) {
        TextView textView;
        if (groupPosition == getEstadoActual()) {
            textView = getGenericView(TEXTVIEW_ACTUAL);
        }
        else {
            textView = getGenericView(TEXTVIEW_NOMBRE);
        }
        textView.setText(getGroup(groupPosition).toString());
        return textView;
    }

    public boolean isChildSelectable(int groupPosition, int childPosition) {
        return true;
    }

    public boolean hasStableIds() {
        return true;
    }

    @Override
    public void notifyDataSetChanged() {
        super.notifyDataSetChanged();
    }

    public Context getContext() {
        return context;
    }

    public void setContext(Context context) {
        this.context = context;
    }

    public ArrayList<String> getNombre() {
        return nombre;
    }

    public void setNombre(ArrayList<String> nombre) {
        this.nombre = nombre;
    }

    public ArrayList<ArrayList<String>> getDescripcion() {
        return descripcion;
    }

    public void setDescripcion(ArrayList<ArrayList<String>> descripcion) {
        this.descripcion = descripcion;
    }

    public int getEstadoActual() {
        return estadoActual;
    }

    public void setEstadoActual(int estadoActual) {
        this.estadoActual = estadoActual;
    }
}
