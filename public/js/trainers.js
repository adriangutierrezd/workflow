import { openModal } from './utils.js'

window.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll('.send-request-button')
    Array.from(buttons).forEach(button => {
        button.addEventListener('click', ({ target }) => {
            document.getElementById('trainer_id').value = target.dataset.trainerId
            openModal('send-request-form-modal')
        })
    })
})