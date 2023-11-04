import { createRow, createCell, createFullTd, showTableLoading } from './tablesService.js'
import { changeButtonStatus, closeModal, openModal } from './utils.js'
import { OPTIONS_DOTS, TRASH_ICON, EDIT_ICON, SPINNER, HTTP_STATUS } from './constants.js'
import { getClusterByWorkout, createCluster, deleteCluster, updateCluster } from './clusterService.js'


const getWorkoutId = () => {
    const segments = window.location.pathname.split('/')
    return segments.pop()
}

const asignMainCheckAsMaster = () => {
    document.getElementById('select_all').addEventListener('change', (ev) => {
        Array.from(document.getElementsByName('clusters[]')).forEach(checkBox => {
            checkBox.checked = ev.target.checked
        })
    })
}

const loadClusters = async () => {
    try {

        const table = document.getElementById('clusters-list')
        $('#clusters-list').DataTable().destroy();

        showTableLoading({ table })

        const { clusters } = await getClusterByWorkout(getWorkoutId())

        table.children[1].innerHTML = ''

        if (clusters.length === 0) {

            const noDataPh = document.createElement('p')
            noDataPh.className = 'text-center text-gray-500 dark:text-gray-400'
            noDataPh.innerText = 'No hay ejercicios registrados'

            const td = createFullTd({
                colSpan: 5,
                innerHTML: noDataPh,
                classes: 'p-2'
            })

            const info = {
                id: `cl_0`
            }

            const tr = createRow(info)
            tr.appendChild(td)
            table.children[1].appendChild(tr)

        } else {

            clusters.forEach(cluster => {

                const info = {
                    id: `cl_${cluster.id}`,
                    datasets: {
                        workout: cluster.workout_id
                    }
                }

                const tr = createRow(info)
                table.children[1].appendChild(tr)

                const checkBoxSelect = document.createElement('input')
                checkBoxSelect.type = 'checkbox'
                checkBoxSelect.name = 'clusters[]'
                checkBoxSelect.dataset.cluster = cluster.id
                checkBoxSelect.className = 'h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-600'
                const tdSelectCheckBox = createCell({
                    text: checkBoxSelect,
                    type: 'td',
                    html: true
                })
                tr.appendChild(tdSelectCheckBox)

                const tdExcercise = createCell({
                    text: cluster.excercise.name,
                    type: 'td'
                })
                tr.appendChild(tdExcercise)


                const tdSets = createCell({
                    text: `${cluster.sets}x${cluster.reps}`,
                    type: 'td'
                })
                tr.appendChild(tdSets)

                const tdWeight = createCell({
                    text: `${cluster.weight} ${cluster.unit}`,
                    type: 'td'
                })
                tr.appendChild(tdWeight)


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
                optionsEdit.className = 'flex items-center cursor-pointer px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900'
                optionsEdit.setAttribute('role', 'menuitem')
                optionsEdit.setAttribute('tabindex', '-1')
                optionsEdit.setAttribute('id', 'options-menu-1')
                optionsEdit.innerHTML = EDIT_ICON

                optionsEdit.addEventListener('click', () => {
                    document.querySelector('input[name=updateClusterId]').value = cluster.id
                    document.querySelector(`select[name=updateExcerciseId] option[value="${cluster.excercise_id}"]`).selected = true
                    document.querySelector('input[name=updateSets]').value = cluster.sets
                    document.querySelector('input[name=updateReps]').value = cluster.reps
                    document.querySelector('input[name=updateWeight]').value = cluster.weight
                    openModal('editClusterModal')
                })

                const optionsEditText = document.createElement('span')
                optionsEditText.className = 'ml-2'
                optionsEditText.innerText = 'Editar'
                optionsEdit.appendChild(optionsEditText)

                const optionsDelete = document.createElement('li')
                optionsDelete.className = 'flex items-center cursor-pointer px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900'
                optionsDelete.setAttribute('role', 'menuitem')
                optionsDelete.setAttribute('tabindex', '-1')
                optionsDelete.setAttribute('id', 'options-menu-1')
                optionsDelete.innerHTML = TRASH_ICON

                optionsDelete.addEventListener('click', () => {
                    openModal('deleteClusterModal')
                    document.querySelector('input[name=clusterDeleteId').value = cluster.id
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

        }

    } catch (error) {
        alert(error.message)
    }
}

document.getElementById('newClusterForm').addEventListener('submit', async (event) => {

    event.preventDefault()

    const excercise_id = document.querySelector('select[name=excercise_id]')
    const sets = document.querySelector('input[name=sets]')
    const reps = document.querySelector('input[name=reps]')
    const weight = document.querySelector('input[name=weight]')
    const workout_id = getWorkoutId()

    const submitBtn = document.getElementById('btnCreateCluster')
    const submitBtnText = submitBtn.innerHTML

    try {

        changeButtonStatus({ button: submitBtn, disabled: true, inner: SPINNER })

        const { status, message } = await createCluster({ workout_id, excercise_id: excercise_id.value, sets: sets.value, reps: reps.value, weight: weight.value })

        if (status === HTTP_STATUS.CREATED) {
            loadClusters()
            document.getElementById('newClusterForm').reset()
            closeModal('newClusterModal')
        } else {
            alert(message)
        }

    } catch (error) {
        alert(error.message)
    } finally {
        changeButtonStatus({ button: submitBtn, disabled: false, inner: submitBtnText })
    }

})

document.getElementById('deleteClusterBtn').addEventListener('click', async (event) => {

    event.preventDefault()

    const previousInnerHTML = event.target.innerHTML
    changeButtonStatus({
        button: event.target,
        disabled: true,
        inner: SPINNER
    })

    try {
        const clusterId = document.getElementById('clusterDeleteId').value
        await deleteCluster(clusterId)
    } catch (error) {
        alert(error.message)
    } finally {

        closeModal('deleteClusterModal')

        setTimeout(() => {
            changeButtonStatus({
                button: event.target,
                disabled: false,
                inner: previousInnerHTML
            })
        }, 500)
        loadClusters()
    }


})

document.getElementById('updateClusterForm').addEventListener('submit', async (event) => {

    event.preventDefault()

    const submitBtn = event.target.querySelector('button[type=submit]')
    const previousInnerHTML = submitBtn.innerHTML

    try {

        changeButtonStatus({ button: submitBtn, disabled: true, inner: SPINNER })

        const clusterId = document.querySelector('input[name=updateClusterId]').value
        const excercise_id = document.querySelector('select[name=updateExcerciseId]')
        const sets = document.querySelector('input[name=updateSets]')
        const reps = document.querySelector('input[name=updateReps]')
        const weight = document.querySelector('input[name=updateWeight]')
        const workout_id = getWorkoutId()

        const { status, message } = await updateCluster({ clusterId, workout_id, excercise_id: excercise_id.value, sets: sets.value, reps: reps.value, weight: weight.value })

        if (status === HTTP_STATUS.OK) {
            loadClusters()
            closeModal('editClusterModal')
        } else {
            alert(message)
        }

    } catch (error) {
        alert(error.message)
    } finally {
        changeButtonStatus({
            button: submitBtn,
            disabled: false,
            inner: previousInnerHTML
        })
    }


})

window.addEventListener('DOMContentLoaded', () => {
    loadClusters()
    asignMainCheckAsMaster()
})

