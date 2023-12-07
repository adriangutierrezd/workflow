import { trans, changeButtonStatus, closeModal } from './utils.js'
import { updateWorkout } from './workoutService.js'
import { SPINNER } from './icons.js'

window.addEventListener('DOMContentLoaded', () => {
    $('#client_selector').select2()
})

document.getElementById('assignWorkoutForm').addEventListener('submit', async (ev) => {
    
    const button = document.getElementById('assignWorkoutForm').querySelector('button[type="submit"]')
    const previousInnerHTML = button.innerHTML
    ev.preventDefault()

    try {
        changeButtonStatus({
            button,
            disabled: true,
            inner: SPINNER
        })

        const workout_id = document.getElementById('workout_id').value
        const client_id = document.getElementById('client_selector').value
        await updateWorkout({ workoutId: workout_id, props: { user_id: client_id } })
        closeModal('optionsDropdown')
        closeModal('assign-workout-form-modal')
    } catch (error) {
        Swal.fire({
            title: 'Error!',
            text: error.message,
            icon: 'error',
            confirmButtonText: trans({ key: 'Okey' })
        })    
    }finally{
        changeButtonStatus({
            button,
            disabled: false,
            inner: previousInnerHTML
        })
    }
})