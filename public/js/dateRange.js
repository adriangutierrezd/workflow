import { WEEK_DAYS, MONTHS } from './constants.js'

export const getDateDate = () => {
    const dateFrom = document.querySelector('input[name="initialDate"]').value
    const dateTo = document.querySelector('input[name="endDate"]').value

    const initialDateObj = new Date(dateFrom)
    const endDateObj = new Date(dateTo)

    return { dateFrom, dateTo, initialDateObj, endDateObj }
}

export const getDateRangeInfo = (startDate, endDate) => {
    const startDay = startDate.getDate()
    const startWeekDay = WEEK_DAYS[startDate.getDay()].substring(0, 3)
    const startMonth = MONTHS[startDate.getMonth()].substring(0, 3)

    const endDay = endDate.getDate()
    const endWeekDay = WEEK_DAYS[endDate.getDay()].substring(0, 3)
    const endMonth = MONTHS[endDate.getMonth()].substring(0, 3)

    return `${startWeekDay} ${startDay} ${startMonth} A ${endWeekDay} ${endDay} ${endMonth}`
}