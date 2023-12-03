import { openModal } from './utils.js'

window.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll('.send-request-button')
    Array.from(buttons).forEach(button => {
        button.addEventListener('click', ({ target }) => {
            const trainerId = target.closest('[data-trainerId]').getAttribute('data-trainerId');
            document.getElementById('trainer_id').value = trainerId
            openModal('send-request-form-modal')
        })
    })
})