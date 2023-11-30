import { getDateRangeInfo, getDateDate } from './dateRange.js'
import { WEEK_DAYS } from './constants.js'
import { getExcerciseData, getExcerciseUsage } from './staticsService.js'
import { closeModal } from './utils.js'


window.addEventListener('DOMContentLoaded', async () => {
    
    const { initialDateObj, endDateObj, dateFrom, dateTo } = getDateDate()
    const rangeInfo = getDateRangeInfo( initialDateObj, endDateObj)
    document.getElementById('dateRangeDropdownInfo').innerText = rangeInfo


    loadExcerciseCharts({ dateFrom, dateTo })
    loadExcerciseUsage({ dateFrom, dateTo })
})

const loadExcerciseCharts = async ({ dateFrom, dateTo }) => {

    const props = {
        userId: User,
        excerciseId: Excercise.id,
        startDate: dateFrom,
        endDate: dateTo
    }

    const { data } = await getExcerciseData(props)
    const weightByWorkout = data.map(d => {
        return {
            date: d.date,
            weight: d.total_weight_per_workout
        }
    })

    const weightByRep = data.map(d => {
        return {
            date: d.date,
            weight: d.average_weight_per_workout
        }
    })

    loadWeightPerWorkout(weightByWorkout)
    loadAverageWeightByRep(weightByRep)
}


const loadWeightPerWorkout = (weightByWorkout) => {

    const chartContainer = document.getElementById('average-weight-by-session-container')
    const chart = echarts.init(chartContainer)

    chart.setOption( {
        xAxis: {
            type: 'category',
            data: weightByWorkout.map(w => w.date)
        },
        yAxis: {
            type: 'value'
        },
        tooltip: {
            trigger: 'axis'
        },
        series: [
        {
            data: weightByWorkout.map(w => w.weight),
            type: 'line',
            smooth: true,
            lineStyle: {   
                color: '#3b82f6' 
            },
            itemStyle: {   
                color: '#3b82f6' 
            }
        }
        ]
    });

}

const loadAverageWeightByRep = (weightByRep) => {
    const chartContainer = document.getElementById('average-weight-by-rep-container')

    
    const chart = echarts.init(chartContainer)

    chart.setOption( {
        xAxis: {
            type: 'category',
            data: weightByRep.map(w => w.date)
        },
        yAxis: {
            type: 'value'
        },
        tooltip: {
            trigger: 'axis'
        },
        series: [
        {
            data: weightByRep.map(w => w.weight),
            type: 'line',
            smooth: true,
            lineStyle: {   
                color: '#3b82f6' 
            },
            itemStyle: {   
                color: '#3b82f6' 
            }
        }
        ]
    });
}

const loadExcerciseUsage = async ({ dateFrom, dateTo }) => {

    const props = {
        userId: User,
        excerciseId: Excercise.id,
        startDate: dateFrom,
        endDate: dateTo
    }
    const { data } = await getExcerciseUsage(props)
    loadExcerciseUsageHeatmap(data)

}

const loadExcerciseUsageHeatmap = (usageData) => {
    const chartContainer = document.getElementById('excercise-usage-container')

    const chart = echarts.init(chartContainer)
    const weeks = [...new Set(usageData.map(d => d.week))]
    const data = usageData.map(d => {
        return [
            --d.DAY,
            weeks.indexOf(d.week),
            Number(d.sets)
        ]
    }).map(function (item) {
        return [item[1], item[0], item[2] || '-'];
    })


    chart.setOption( {
        tooltip: {
            position: 'top'
        },
        grid: {
            height: '50%',
            top: '10%'
        },
        xAxis: {
            type: 'category',
            data: weeks,
            splitArea: {
                show: true
            }
        },
        yAxis: {
            type: 'category',
            data: WEEK_DAYS,
            splitArea: {
                show: true
            }
        },
        visualMap: {
            min: 0,
            max: 10,
            calculable: true,
            orient: 'horizontal',
            left: 'center',
            bottom: '15%',
            inRange: {
                color: ['#eff6ff', '#1e40af']
            }
        },
        series: [
        {
            name: 'Sets',
            type: 'heatmap',
            data: data,
            label: {
                show: true
            },
            emphasis: {
                itemStyle: {
                    shadowBlur: 10,
                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                }
            }
        }
        ]
    });
}

document.getElementById('date-range-form').addEventListener('submit', async(ev) => {

    ev.preventDefault()
    closeModal('dateRangeDropdown')

    const { dateFrom, dateTo, initialDateObj, endDateObj } = getDateDate()

    const rangeInfo = getDateRangeInfo( initialDateObj, endDateObj)
    document.getElementById('dateRangeDropdownInfo').innerText = rangeInfo

    loadExcerciseCharts({ dateFrom, dateTo })
    loadExcerciseUsage({ dateFrom, dateTo })
})