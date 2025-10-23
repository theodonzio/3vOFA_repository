#!/bin/bash
# CONFIGURACIÓN
USER="OFA"
PASS="ofametamate"
DB="db_OFA"
while true; do
    clear
    echo "1. Ver usuarios"
    echo "2. Agregar"
    echo "3. Eliminar"
    echo "4. Modificar"
    echo "5. Salir"
    read -p "Opción: " op
    
    case $op in
        1)
            mysql -u$USER -p$PASS $DB -e "SELECT * FROM usuario;"
            read -p "Enter..."
            ;;
        2)
            read -p "Nombre: " n
            read -p "Apellido: " a
            read -p "Cédula: " c
            read -p "Email: " e
            read -p "Contraseña: " p
            
            # Hashear la contraseña con SHA-256
            p_hash=$(echo -n "$p" | sha256sum | awk '{print $1}')
            
            # Solicitar el rol con validación
            while true; do
                read -p "ID Rol (1-3): " r
                if [[ "$r" =~ ^[1-3]$ ]]; then
                    break
                else
                    echo "Error: Debe ingresar un número entre 1 y 3"
                fi
            done
            
            mysql -u$USER -p$PASS $DB -e "INSERT INTO usuario (nombre,apellido,cedula,email,contrasena,id_rol) VALUES ('$n','$a','$c','$e','$p_hash',$r);"
            echo "Listo"
            read -p "Enter..."
            ;;
        3)
            mysql -u$USER -p$PASS $DB -e "SELECT id_usuario,nombre,apellido,email FROM usuario;"
            read -p "ID a eliminar: " id
            
            echo "Eliminando registros relacionados..."
            
            # Eliminar de tablas relacionadas en el orden correcto
            mysql -u$USER -p$PASS $DB -e "DELETE FROM estudiante_grupo WHERE id_usuario=$id;"
            mysql -u$USER -p$PASS $DB -e "DELETE FROM informe WHERE id_usuario=$id;"
            mysql -u$USER -p$PASS $DB -e "DELETE FROM reserva WHERE id_docente=$id OR id_aprobador=$id;"
            mysql -u$USER -p$PASS $DB -e "DELETE FROM grupo_asignatura WHERE id_docente=$id;"
            
            # Ahora eliminar el usuario
            mysql -u$USER -p$PASS $DB -e "DELETE FROM usuario WHERE id_usuario=$id;"
            
            if [ $? -eq 0 ]; then
                echo "Usuario eliminado correctamente"
            else
                echo "Error al eliminar el usuario"
            fi
            read -p "Enter..."
            ;;
        4)
            mysql -u$USER -p$PASS $DB -e "SELECT * FROM usuario;"
            read -p "ID a modificar: " id
            
            read -p "Nuevo nombre: " n
            read -p "Nuevo apellido: " a
            read -p "Nueva cédula: " c
            read -p "Nuevo email: " e
            read -p "Nueva contraseña: " p
            
            # Hashear la contraseña con SHA-256
            p_hash=$(echo -n "$p" | sha256sum | awk '{print $1}')
            
            # Solicitar el rol con validación
            while true; do
                read -p "Nuevo ID Rol (1-3): " r
                if [[ "$r" =~ ^[1-3]$ ]]; then
                    break
                else
                    echo "Error: Debe ingresar un número entre 1 y 3"
                fi
            done
            
            mysql -u$USER -p$PASS $DB -e "UPDATE usuario SET nombre='$n', apellido='$a', cedula='$c', email='$e', contrasena='$p_hash', id_rol=$r WHERE id_usuario=$id;"
            echo "Modificado"
            read -p "Enter..."
            ;;
        5)
            exit
            ;;
        *)
            echo "Opción inválida"
            read -p "Enter..."
            ;;
    esac
done