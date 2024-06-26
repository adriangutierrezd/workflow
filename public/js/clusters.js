import { createRow, createCell, createFullTd, showTableLoading } from './tablesService.js'
import { changeButtonStatus, closeModal, openModal, createDialogDropDownItem, createDialogDropDownContainer, createDialogDroDownBtn, trans } from './utils.js'
import { HTTP_STATUS } from './constants.js'
import { getClusterByWorkout, createCluster, deleteCluster, updateCluster } from './clusterService.js'
import { OPTIONS_DOTS, TRASH_ICON, EDIT_ICON, SPINNER, CHECK_ICON } from './icons.js'


const getWorkoutId = () => {
    const segments = window.location.pathname.split('/')
    return segments.pop()
}

const asignMainCheckAsMaster = () => {
    document.getElementById('select_all')?.addEventListener('change', (ev) => {
        Array.from(document.getElementsByName('clusters[]')).forEach(checkBox => {
            checkBox.checked = ev.target.checked
        })
    })
}

const loadClusters = async () => {
    try {

        const table = document.getElementById('clusters-list')
        if ($.fn.DataTable.isDataTable('#clusters-list')) {
            dataTable.clear().destroy();
        }

        showTableLoading({ table })

        const { clusters } = await getClusterByWorkout(getWorkoutId())

        table.children[1].innerHTML = ''

        if (clusters.length === 0) {

            const noDataPh = document.createElement('p')
            noDataPh.className = 'text-center text-gray-500 dark:text-gray-400'
            noDataPh.innerText = trans({ key: 'No exercises have been recorded' })

            const td = createFullTd({
                colSpan: 4,
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

                const tdClasses = cluster.done ? 'line-through' : ''

                const info = {
                    id: `cl_${cluster.id}`,
                    datasets: {
                        workout: cluster.workout_id
                    }
                }

                const tr = createRow(info)
                table.children[1].appendChild(tr)

                const tdExcercise = createCell({
                    text: cluster.excercise.name,
                    classes: tdClasses,
                    type: 'td'
                })
                tr.appendChild(tdExcercise)


                const tdSets = createCell({
                    text: `${cluster.sets}x${cluster.reps}`,
                    classes: tdClasses,
                    type: 'td'
                })
                tr.appendChild(tdSets)

                const tdWeight = createCell({
                    text: `${cluster.weight} ${cluster.unit}`,
                    classes: tdClasses,
                    type: 'td'
                })
                tr.appendChild(tdWeight)


                const parentOptionsDiv = document.createElement('div')

                const optionsButton = createDialogDroDownBtn({ icon: OPTIONS_DOTS })
                const optionsDiv = createDialogDropDownContainer()

                const optionsList = document.createElement('ul')
                optionsList.className = 'py-1'
                optionsList.setAttribute('role', 'none')


                const optionsEdit = createDialogDropDownItem({ icon: EDIT_ICON, text: trans({ key: 'Edit' }) })
                optionsEdit.addEventListener('click', () => {
                    document.querySelector('input[name=updateClusterId]').value = cluster.id
                    $('[name=updateExcerciseId]').val(cluster.excercise_id).trigger('change');
                    document.querySelector('input[name=updateSets]').value = cluster.sets
                    document.querySelector('input[name=updateReps]').value = cluster.reps
                    document.querySelector('input[name=updateWeight]').value = cluster.weight
                    openModal('edit-cluster-form-modal')
                })
                optionsList.appendChild(optionsEdit)


                const clusterStatusProps = !cluster.done ? {
                    icon: CHECK_ICON, text: `${trans({ key: 'Check' })} (${trans({ key: 'Done' })})`
                } : {
                    icon: CHECK_ICON, text: `${trans({ key: 'Check' })} (${trans({ key: 'Pending' })})`
                }

                const optionsMarkAsDone = createDialogDropDownItem(clusterStatusProps)
                optionsMarkAsDone.addEventListener('click', async () => {

                    await updateCluster({
                        clusterId: cluster.id,
                        props: {
                            done: !cluster.done
                        }
                    })

                    loadClusters()

                })
                optionsList.appendChild(optionsMarkAsDone)

                const optionsDelete = createDialogDropDownItem({ icon: TRASH_ICON, text: trans({ key: 'Delete' }) })
                optionsDelete.addEventListener('click', () => {
                    openModal('delete-cluster-form-modal')
                    document.querySelector('input[name=clusterDeleteId').value = cluster.id
                })
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
        Swal.fire({
            title: 'Error!',
            text: error.message,
            icon: 'error',
            confirmButtonText: trans({ key: 'Okey' })
        })    
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
            closeModal('new-cluster-form-modal')
        } else {
            Swal.fire({
                title: 'Error!',
                text: message,
                icon: 'error',
                confirmButtonText: trans({ key: 'Okey' })
            })    
        }

    } catch (error) {
        Swal.fire({
            title: 'Error!',
            text: error.message,
            icon: 'error',
            confirmButtonText: trans({ key: 'Okey' })
        })    
    } finally {
        $('select[name=excercise_id]').val(null).trigger('change');
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
        Swal.fire({
            title: 'Error!',
            text: error.message,
            icon: 'error',
            confirmButtonText: trans({ key: 'Okey' })
        })    
    } finally {

        closeModal('delete-cluster-form-modal')

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

        const params = {
            clusterId,
            props: {
                workout_id,
                excercise_id: excercise_id.value,
                sets: sets.value,
                reps: reps.value,
                weight: weight.value
            }
        }

        const { status, message } = await updateCluster(params)

        if (status === HTTP_STATUS.OK) {
            loadClusters()
            closeModal('edit-cluster-form-modal')
        } else {
            Swal.fire({
                title: 'Error!',
                text: message,
                icon: 'error',
                confirmButtonText: trans({ key: 'Okey' })
            })    
        }

    } catch (error) {
        Swal.fire({
            title: 'Error!',
            text: error.message,
            icon: 'error',
            confirmButtonText: trans({ key: 'Okey' })
        })    
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

