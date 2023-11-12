import { closeModal } from './utils.js'
import { updateWorkout } from './workoutService.js'

window.addEventListener('DOMContentLoaded', () => {
    $('#client_selector').select2()
})

document.getElementById('assignWorkoutForm').addEventListener('submit', async (ev) => {
    try {

        ev.preventDefault()
        const workout_id = document.getElementById('workout_id').value
        const client_id = document.getElementById('client_selector').value
        await updateWorkout({ workoutId: workout_id, props: { user_id: client_id } })
        closeModal('optionsDropdown')
        closeModal('assignWorkoutModal')
    } catch (error) {
        alert(error.message)
    }
})