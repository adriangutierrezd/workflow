import { getWorkouts } from './workoutService.js'
import { createRow, createCell } from './tablesService.js'
import { generateProgressBar } from './utils.js'
import { OPTIONS_DOTS, TRASH_ICON, EDIT_ICON } from './constants.js'

window.addEventListener('DOMContentLoaded', async () => {
    try {

        const table = document.getElementById('workouts-list')

        const workouts = await getWorkouts()
        workouts[0].forEach(workout => {
            const info = {
                id: `wk_${workout.id}`,
                datasets: {
                    title: workout.title,
                    date: workout.date
                }
            }

            const tr = createRow(info)
            table.children[1].appendChild(tr)

            const tdTitle = createCell({
                text: workout.title,
                type: 'td'
            })
            tr.appendChild(tdTitle)

            const tdDate = createCell({
                text: workout.date,
                type: 'td'
            })
            tr.appendChild(tdDate)

            const statusDiv = document.createElement('div')
            statusDiv.className = `badge-status badge-status-${workout.status.name.toLowerCase().replace(/ /g, '-')}`
            statusDiv.innerText = workout.status.name
            const tdStatus = createCell({
                text: statusDiv,
                type: 'td',
                html: true
            })
            tr.appendChild(tdStatus)


            const tdPeople = createCell({
                text: `<img class="object-cover w-6 h-6 -mx-1 border-2 border-white rounded-full dark:border-gray-700 shrink-0" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=256&q=80" alt="">`,
                html: true,
                type: 'td'
            })
            tr.appendChild(tdPeople)

            const progressBar = generateProgressBar({
                classes: 'w-48 h-1.5 overflow-hidden rounded-full',
                progress: Math.random() * 100,
                bgColor: 'bg-blue-200',
                color: 'bg-blue-500'
            })

            const tdProgress = createCell({
                text: progressBar,
                html: true,
                type: 'td'
            })
            tr.appendChild(tdProgress)

            const parentOptionsDiv = document.createElement('div')
            parentOptionsDiv.className = 'relative'

            const optionsButton = document.createElement('button')
            optionsButton.className = 'px-1 py-1 text-gray-500 transition-colors duration-200 rounded-lg dark:text-gray-300 hover:bg-gray-100'
            optionsButton.innerHTML = OPTIONS_DOTS
            optionsButton.setAttribute('aria-haspopup', 'true')
            optionsButton.setAttribute('aria-expanded', 'true')
            optionsButton.setAttribute('type', 'button')

            const optionsDiv = document.createElement('div')
            optionsDiv.className = 'hidden absolute right-0 z-10 w-48 mt-2 origin-top-right rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5'
            optionsDiv.setAttribute('role', 'menu')
            optionsDiv.setAttribute('aria-orientation', 'vertical')
            optionsDiv.setAttribute('aria-labelledby', 'options-menu')
            optionsDiv.setAttribute('tabindex', '-1')

            const optionsList = document.createElement('ul')
            optionsList.className = 'py-1'
            optionsList.setAttribute('role', 'none')

            const optionsEdit = document.createElement('li')
            optionsEdit.className = 'block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900'
            optionsEdit.setAttribute('role', 'menuitem')
            optionsEdit.setAttribute('tabindex', '-1')
            optionsEdit.setAttribute('id', 'options-menu-0')

            const optionsEditLink = document.createElement('a')
            optionsEditLink.className = 'flex items-center'
            optionsEditLink.setAttribute('href', `/workout/edit/${workout.id}`)
            optionsEditLink.innerHTML = EDIT_ICON
            const optionsEditLinkText = document.createElement('span')
            optionsEditLinkText.className = 'ml-2'
            optionsEditLinkText.innerText = 'Editar'
            optionsEditLink.appendChild(optionsEditLinkText)
            optionsEdit.appendChild(optionsEditLink)

            const optionsDelete = document.createElement('li')
            optionsDelete.className = 'flex items-center cursor-pointer px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900'
            optionsDelete.setAttribute('role', 'menuitem')
            optionsDelete.setAttribute('tabindex', '-1')
            optionsDelete.setAttribute('id', 'options-menu-1')
            optionsDelete.innerHTML = TRASH_ICON

            optionsDelete.addEventListener('click', () => {

                const modalCta = document.getElementById('modalDeleteWorkoutCta')
                const ev = new Event('click')
                modalCta.dispatchEvent(ev)
            })

            const optionsDeleteText = document.createElement('span')
            optionsDeleteText.className = 'ml-2'
            optionsDeleteText.innerText = 'Eliminar'
            optionsDelete.appendChild(optionsDeleteText)

            optionsList.appendChild(optionsEdit)
            optionsList.appendChild(optionsDelete)

            optionsDiv.appendChild(optionsList)


            parentOptionsDiv.appendChild(optionsButton)
            parentOptionsDiv.appendChild(optionsDiv)


            optionsButton.addEventListener('click', () => {
                optionsDiv.classList.toggle('hidden')
            })

            document.addEventListener('click', (e) => {
                if (!parentOptionsDiv.contains(e.target)) {
                    optionsDiv.classList.add('hidden')
                }
            })

            const tdActions = createCell({
                text: parentOptionsDiv,
                html: true,
                type: 'td'
            })
            tr.appendChild(tdActions)

        })

        $('#workouts-list').DataTable({
            info: false,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Buscar..."
            }
        })


    } catch (error) {
        console.log(error)
    }
})