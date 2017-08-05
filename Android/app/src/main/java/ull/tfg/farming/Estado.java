package ull.tfg.farming;

public class Estado {

    // DECLARACIÓN DE CONSTANTES.
    final static int CODIGO_DEFECTO = 0;
    final static String NOMBRE_DEFECTO = "Estado";

    // DECLARACIÓN DE ATRIBUTOS.
    private int codigo;
    private String nombre;

    /**
     * Constructor por defecto.
     */
    public Estado() {
        codigo = CODIGO_DEFECTO;
        nombre = NOMBRE_DEFECTO;
    }

    /**
     * Constructor.
     * @param codigo Código del estado.
     * @param nombre Nombre del estado.
     */
    public Estado(int codigo, String nombre) {
        this.codigo = codigo;
        this.nombre = nombre;
    }

    @Override
    public String toString() {
        return (codigo + " " + nombre);
    }

    @Override
    public boolean equals(Object object) {
        if (this == object) return true;
        if (object == null || getClass() != object.getClass()) return false;
        Estado estado = (Estado) object;
        if (codigo != estado.codigo) return false;
        return nombre != null ? nombre.equals(estado.nombre) : estado.nombre == null;
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
}
