/*
 * Clase para la implementación de estados de una planta.
 * @author: Eduardo Escobar Alberto
 * @version: 1.0 05/09/2017
 * Correo electrónico: eduescal13@gmail.com.
 * Asignatura: Trabajo de Fin de Grado.
 * Centro: Universidad de La Laguna.
 */

package ull.tfg.fadming;

public class Estado {

    // DECLARACIÓN DE CONSTANTES.
    final static int CODIGO_DEFECTO = 0;
    final static String NOMBRE_DEFECTO = "Estado";
    final static String DESCRIPCION_DEFECTO = "Descripción";
    final static boolean ACTUAL_DEFECTO = false;

    // DECLARACIÓN DE ATRIBUTOS.
    private int codigo;
    private String nombre;
    private String descripcion;
    private boolean actual;

    /**
     * Constructor por defecto.
     */
    public Estado() {
        codigo = CODIGO_DEFECTO;
        nombre = NOMBRE_DEFECTO;
        descripcion = DESCRIPCION_DEFECTO;
        actual = ACTUAL_DEFECTO;
    }

    /**
     * Constructor.
     * @param codigo Código del estado.
     * @param nombre Nombre del estado.
     * @param descripcion Descripción del estado.
     */
    public Estado(int codigo, String nombre, String descripcion, boolean actual) {
        this.codigo = codigo;
        this.nombre = nombre;
        this.descripcion = descripcion;
        this.actual = actual;
    }

    @Override
    public String toString() {
        return (getCodigo() + " " + getNombre() + " " + getDescripcion() + " " + isActual());
    }

    @Override
    public boolean equals(Object object) {
        if (this == object) return true;
        if (object == null || getClass() != object.getClass()) return false;
        Estado estado = (Estado) object;
        if (getCodigo() != estado.getCodigo()) return false;
        if (isActual() != estado.isActual()) return false;
        if (getNombre() != null ? !getNombre().equals(estado.getNombre()) : estado.getNombre() != null)
            return false;
        return getDescripcion() != null ? getDescripcion().equals(estado.getDescripcion()) : estado.getDescripcion() == null;
    }

    public int getCodigo() {
        return codigo;
    }

    public void setCodigo(int codigo) {
        this.codigo = codigo;
    }

    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public String getDescripcion() {
        return descripcion;
    }

    public void setDescripcion(String descripcion) {
        this.descripcion = descripcion;
    }

    public boolean isActual() {
        return actual;
    }

    public void setActual(boolean actual) {
        this.actual = actual;
    }
}
