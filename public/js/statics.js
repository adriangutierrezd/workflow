import { getWorkoutsAbstract } from './workoutService.js'
import { WEEK_DAYS, MONTHS } from './constants.js'
import { closeModal } from './utils.js'

window.addEventListener('DOMContentLoaded', async () => {

    if (document.getElementById('dateRangeDropdown')) {
        const { initialDateObj, endDateObj } = getDateDate()
        changeDateRangeDropdownInfo(initialDateObj, endDateObj)
    }


    const { data } = await getWorkoutsAbstract({ userId: User })
    updateWorkoutsAbstractData({ workoutsData: data })

})

document.getElementById('date-range-form').addEventListener('submit', async(ev) => {

    ev.preventDefault()
    closeModal('dateRangeDropdown')

    const { dateFrom, dateTo, initialDateObj, endDateObj } = getDateDate()

    const { data } = await getWorkoutsAbstract({ userId: User, startDate: dateFrom, endDate: dateTo })
    updateWorkoutsAbstractData({ workoutsData: data })
    changeDateRangeDropdownInfo(initialDateObj, endDateObj)
})

const updateWorkoutsAbstractData = ({ workoutsData }) => {
    const plannedLabel = document.querySelector('[data-label="planned-workouts"]')
    const completedLabel = document.querySelector('[data-label="completed-workouts"]')
    const cancelledLabel = document.querySelector('[data-label="cancelled-workouts"]')
    plannedLabel.innerText = workoutsData.totalWorkouts ?? 0
    completedLabel.innerText = workoutsData?.workoutsByStatus['Completado']?.length ?? 0
    cancelledLabel.innerText = workoutsData?.workoutsByStatus['Cancelado']?.length ?? 0

}

const getDateDate = () => {
    const dateFrom = document.querySelector('input[name="initialDate"]').value
    const dateTo = document.querySelector('input[name="endDate"]').value

    const initialDateObj = new Date(dateFrom)
    const endDateObj = new Date(dateTo)

    return { dateFrom, dateTo, initialDateObj, endDateObj }
}

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