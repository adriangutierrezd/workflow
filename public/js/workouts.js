import { getWorkouts, deleteWorkout } from './workoutService.js'
import { createRow, createCell, createFullTd, showTableLoading } from './tablesService.js'
import { generateProgressBar, changeButtonStatus, createDialogDroDownBtn, createDialogDropDownContainer, createDialogDropDownItem, closeModal, openModal, trans } from './utils.js'
import { OPTIONS_DOTS, TRASH_ICON, EDIT_ICON, SPINNER, WEEK_DAYS, MONTHS } from './constants.js'

const loadWorkouts = async (props = {}) => {
    try {

        const { startDate, endDate, allowedStates } = props

        const table = document.getElementById('workouts-list')
        $('#workouts-list').DataTable().destroy();

        showTableLoading({ table })

        const workouts = await getWorkouts({ startDate, endDate })

        table.children[1].innerHTML = ''

        if (workouts.data.length === 0) {

            const noDataPh = document.createElement('p')
            noDataPh.className = 'text-center text-gray-500 dark:text-gray-400'
            noDataPh.innerText = trans({ key: 'No workouts have been recorded' })

            const td = createFullTd({
                colSpan: 6,
                innerHTML: noDataPh,
                classes: 'p-2'
            })

            const info = {
                id: `wk_0`
            }

            const tr = createRow(info)
            tr.appendChild(td)
            table.children[1].appendChild(tr)

        } else {
            workouts.data.forEach(workout => {

                if (allowedStates !== undefined && allowedStates.length > 0 && !allowedStates.includes(workout.status.name)) return

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

                let avatarText = `<img class="object-cover w-6 h-6 -mx-1 border-2 border-white rounded-full dark:border-gray-700 shrink-0" src="${workout.user.image_url}" alt="">`
                if (workout.user.id != workout.owner.id) {
                    avatarText = `
                    <div class="flex items-center">
                        <img class="object-cover w-6 h-6 -mx-1 rounded-full ring ring-white dark:ring-gray-900" src="${workout.user.image_url}" alt="">
                        <img class="object-cover w-6 h-6 -mx-1 rounded-full ring ring-white dark:ring-gray-900" src="${workout.owner.image_url}" alt="">
                    </div>
                    `
                }

                const tdPeople = createCell({
                    text: avatarText,
                    html: true,
                    type: 'td'
                })
                tr.appendChild(tdPeople)

                const progressBar = generateProgressBar({
                    classes: 'w-48 h-1.5 overflow-hidden rounded-full',
                    progress: workout.completition,
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

                const optionsButton = createDialogDroDownBtn({ icon: OPTIONS_DOTS })
                const optionsDiv = createDialogDropDownContainer()

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
                optionsEditLinkText.innerText = trans({ key: 'Edit' })
                optionsEditLink.appendChild(optionsEditLinkText)
                optionsEdit.appendChild(optionsEditLink)

                const optionsDelete = createDialogDropDownItem({ icon: TRASH_ICON, text: trans({ key: 'Delete' }) })
                optionsDelete.addEventListener('click', () => {
                    document.getElementById('workoutDeleteId').value = workout.id
                    openModal('deleteWorkoutModal')
                })

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
                language: translations,
                order: [{
                    0: 'desc'
                }]
            })
        }

    } catch (error) {
        console.log(error)
    }

}

document.getElementById('deleteBtn').addEventListener('click', async (ev) => {
    ev.preventDefault()

    const previousInnerHTML = ev.target.innerHTML
    changeButtonStatus({
        button: ev.target,
        disabled: true,
        inner: SPINNER
    })

    try {
        const workoutId = document.getElementById('workoutDeleteId').value
        await deleteWorkout(workoutId)
    } catch (error) {
        Swal.fire({
            title: 'Error!',
            text: error.message,
            icon: 'error',
            confirmButtonText: trans({ key: 'Okey' })
        })    
    } finally {
        closeModal('deleteWorkoutModal')
        setTimeout(() => {
            changeButtonStatus({
                button: ev.target,
                disabled: false,
                inner: previousInnerHTML
            })
        }, 500)
        loadWorkouts()
    }
})


document.getElementById('date-range-form')?.addEventListener('submit', (ev) => {
    ev.preventDefault()

    const { dateFrom, dateTo, initialDateObj, endDateObj } = getDateDate()

    if (initialDateObj > endDateObj) {
        Swal.fire({
            title: 'Error!',
            text: trans({ key: 'The start date cannot be greater than the end date.' }),
            icon: 'error',
            confirmButtonText: trans({ key: 'Okey' })
        })
        return
    }

    loadWorkouts({ startDate: dateFrom, endDate: dateTo })
    changeDateRangeDropdownInfo(initialDateObj, endDateObj)
    closeModal('dateRangeDropdown')

})


const changeDateRangeDropdownInfo = (startDate, endDate) => {
    const infoContainer = document.getElementById('dateRangeDropdownInfo')

    const startDay = startDate.getDate()
    const startWeekDay = WEEK_DAYS[startDate.getDay()].substring(0, 3)
    const startMonth = MONTHS[startDate.getMonth()].substring(0, 3)

    const endDay = endDate.getDate()
    const endWeekDay = WEEK_DAYS[endDate.getDay()].substring(0, 3)
    const endMonth = MONTHS[endDate.getMonth()].substring(0, 3)

    infoContainer.innerText = `${startWeekDay} ${startDay} ${startMonth} A ${endWeekDay} ${endDay} ${endMonth}`

}

const getDateDate = () => {
    const dateFrom = document.querySelector('input[name="initialDate"]').value
    const dateTo = document.querySelector('input[name="endDate"]').value

    const initialDateObj = new Date(dateFrom)
    const endDateObj = new Date(dateTo)

    return { dateFrom, dateTo, initialDateObj, endDateObj }
}


window.addEventListener('DOMContentLoaded', () => {

    if (document.getElementById('dateRangeDropdown')) {
        const { initialDateObj, endDateObj } = getDateDate()
        changeDateRangeDropdownInfo(initialDateObj, endDateObj)
    }

    loadWorkouts({ allowedStates: displayStatesJson })
})