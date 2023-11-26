import { getWorkoutsAbstract } from './workoutService.js'
import { staticsPerExcercise } from './staticsService.js'
import { createDialogDroDownBtn, createDialogDropDownContainer, closeModal } from './utils.js'
import { showTableLoading, createFullTd, createRow, createCell } from './tablesService.js'
import { OPTIONS_DOTS, EXTERNAL_LINK_ICON } from './constants.js'
import { getDateRangeInfo, getDateDate } from './dateRange.js'


window.addEventListener('DOMContentLoaded', async () => {

    if (document.getElementById('dateRangeDropdown')) {
        const { initialDateObj, endDateObj } = getDateDate()
        const rangeInfo = getDateRangeInfo( initialDateObj, endDateObj)
        document.getElementById('dateRangeDropdownInfo').innerText = rangeInfo
    }

    const props = {
        props: {
            userId: User
        }
    }

    handleWorkoutsAbstractUpdate(props)
    handleStaticPerExcerciseUpdate(props)
})

const handleStaticPerExcerciseUpdate = async ({props}) => {


    const table = document.getElementById('statics-per-excercise')
    if ($.fn.DataTable.isDataTable('#statics-per-excercise')) {
        window.dataTable.clear().destroy();
    }

    showTableLoading({ table })

    const { data } = await staticsPerExcercise(props)

    table.children[1].innerHTML = ''

    if(data.length){

        data.forEach(excerciseData => {

            const { name, sets, reps, excercise_id, average_weight, workout_appearences } = excerciseData

            const info = {
                id: `exd_${excercise_id}`,
                datasets: {
                    excercise: excercise_id
                }
            }

            const tr = createRow(info)
            table.children[1].appendChild(tr)

            const tdName = createCell({ text: name, type: 'td' })
            tr.appendChild(tdName)

            const tdSets = createCell({ text: sets, type: 'td' })
            tr.appendChild(tdSets)

            const tdReps = createCell({ text: reps, type: 'td' })
            tr.appendChild(tdReps)

            const tdWokts = createCell({ text: workout_appearences, type: 'td' })
            tr.appendChild(tdWokts)

            const tdAvgW = createCell({ text: average_weight, type: 'td' })
            tr.appendChild(tdAvgW)

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
            optionsEditLink.setAttribute('href', `/excercise-statics/${excercise_id}/${User}`)
            optionsEditLink.innerHTML = EXTERNAL_LINK_ICON
            const optionsEditLinkText = document.createElement('span')
            optionsEditLinkText.className = 'ml-2'
            optionsEditLinkText.innerText = 'Ver'
            optionsEditLink.appendChild(optionsEditLinkText)
            optionsEdit.appendChild(optionsEditLink)

            optionsList.appendChild(optionsEdit)

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

            const tdAcciones = createCell({
                text: parentOptionsDiv,
                type: 'td',
                html: true
            })
            tr.appendChild(tdAcciones)

        })

        
        window.dataTable = $('#statics-per-excercise').DataTable({
            info: false,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Buscar..."
            }
        })


    }else{
        const td = createFullTd({
            colSpan: table.children[0].children[0].children.length,
            innerHTML: 'No data found',
            classes: 'p-2 text-center'
        })
        const tr = createRow({})
        tr.appendChild(td)
        table.children[1].appendChild(tr)
        return
    }


}

const handleWorkoutsAbstractUpdate = async ({props}) => {
    const { data } = await getWorkoutsAbstract(props)
    updateWorkoutsAbstractData({ workoutsData: data })
}

document.getElementById('date-range-form').addEventListener('submit', async(ev) => {

    ev.preventDefault()
    closeModal('dateRangeDropdown')

    const { dateFrom, dateTo, initialDateObj, endDateObj } = getDateDate()


    const props = {
        props: {
            userId: User, 
            startDate: dateFrom,
            endDate: dateTo
        }
    }

    handleWorkoutsAbstractUpdate(props)
    handleStaticPerExcerciseUpdate(props)
    const rangeInfo = getDateRangeInfo( initialDateObj, endDateObj)
    document.getElementById('dateRangeDropdownInfo').innerText = rangeInfo
})

const updateWorkoutsAbstractData = ({ workoutsData }) => {
    const plannedLabel = document.querySelector('[data-label="planned-workouts"]')
    const completedLabel = document.querySelector('[data-label="completed-workouts"]')
    const cancelledLabel = document.querySelector('[data-label="cancelled-workouts"]')
    plannedLabel.innerText = workoutsData.totalWorkouts ?? 0
    completedLabel.innerText = workoutsData?.workoutsByStatus['Completado']?.length ?? 0
    cancelledLabel.innerText = workoutsData?.workoutsByStatus['Cancelado']?.length ?? 0

}
