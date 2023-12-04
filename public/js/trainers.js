import { openModal, trans } from './utils.js'
import { deleteClient } from './clientsService.js'


window.addEventListener('DOMContentLoaded', () => {

    // $('#trainers-list').DataTable({
    //     info: false,
    //     language: translations
    // })

    const buttons = document.querySelectorAll('.send-request-button')
    Array.from(buttons).forEach(button => {
        button.addEventListener('click', ({ target }) => {
            const trainerId = target.closest('[data-trainerId]').getAttribute('data-trainerId');
            document.getElementById('trainer_id').value = trainerId
            openModal('send-request-form-modal')
        })
    })
})

document.getElementById('deleteTrainerUserButton')?.addEventListener('click', async () => {

    const clientTrainerId = document.getElementById('trainerUserId').value

    try {
        await deleteClient({ clientTrainerId })
        window.location.reload()
    } catch (error) {
        Swal.fire({
            title: 'Error!',
            text: error.message,
            icon: 'error',
            confirmButtonText: trans({ key: 'Okey' })
        })
    }

});