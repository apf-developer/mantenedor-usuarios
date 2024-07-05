import Swal from 'sweetalert2'
import axios from 'axios'
import { useAuthStore } from './stores/auth'

/**
 * Muestra mensajes de alerta
 */
export function show_alert(msg, icon, text)
{
    Swal.fire({
        title: msg,
        icon: icon,
        html: text,
        customClass: {
            confirmButton: 'btn btn-primary',
            popup: 'animated zoomIn'
        },
        buttonsStyling: false
    });
}

/**
 * Funcion para controlar la eliminación de usuarios
 */
export function confirmed(id)
{
    let url = 'http://127.0.0.1:8000/api/users/delete/'+id

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success m-1",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });
    
    swalWithBootstrapButtons.fire({
        title: "¿Está seguro?",
        text: "¡No podrás revertir esto!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Continuar",
        cancelButtonText: "Cancelar",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            sendRequest('DELETE', {id: id}, url, '/dashboard')
        } else {
            show_alert("Operación cancelada!", "error", "Usuario no eliminado.")
        }
    });
}

/**
 * Envia las solicitudes, que utilizará el CRUD de usuarios
 */
export async function sendRequest(method, params, url, redirect)
{
    const authStore = useAuthStore()
    axios.defaults.headers.common['Authorization'] = 'Bearer ' + authStore.authToken

    let status, msg
    await axios({
        method:method,
        url: url,
        data: params
    }).then((response) => {
        status = response.data.status
        msg    = response.data.msg

        show_alert(msg, "success", '');
        setTimeout(() => window.location.href = redirect, 1000);
    }).catch((errors) => {
        let obj  = errors.response.data.errors
        let desc = ''

        for (const prop in obj) {
            desc = desc + '<br>' + obj[prop][0]
        }

        show_alert(msg, 'error', desc)
    })

    return status
}