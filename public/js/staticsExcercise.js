import { getDateRangeInfo, getDateDate } from './dateRange.js'
import { WEEK_DAYS } from './constants.js'
import { getExcerciseData, getExcerciseUsage } from './staticsService.js'
import { closeModal, trans } from './utils.js'
import { getChartStyles } from './chartsUtils.js'

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

    const { yAxisSplitLine } = getChartStyles()


    chart.setOption( {
        xAxis: {
            type: 'category',
            data: weightByWorkout.map(w => w.date)
        },
        yAxis: {
            type: 'value',
            splitLine: yAxisSplitLine ?? {}
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

    const { yAxisSplitLine } = getChartStyles()

    chart.setOption( {
        xAxis: {
            type: 'category',
            data: weightByRep.map(w => w.date)
        },
        yAxis: {
            type: 'value',
            splitLine: yAxisSplitLine ?? {}
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

    const totalHeight = 35 * usageData.length
    chartContainer.style.height = `${totalHeight}px`

    const chart = echarts.init(chartContainer)
    const wkyrs = [...new Set(usageData.map(d => d.wkyr))]
    const data = usageData.map(d => {
        return [
            wkyrs.indexOf(d.wkyr),
            --d.DAY,
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
            height: '95%',
            top: '5%'
        },
        xAxis: {
            type: 'category',
            data: WEEK_DAYS,
            splitArea: {
                show: true
            },
            position: 'top'
        },
        yAxis: {
            type: 'category',
            data: wkyrs,
            splitArea: {
                show: true
            }
        },
        visualMap: {
            min: 0,
            max: usageData.sort((a, b) => b.sets - a.sets)[0].sets,
            calculable: true,
            orient: 'horizontal',
            left: 'center',
            top: '1%',
            inRange: {
                color: ['#eff6ff', '#1e40af']
            }
        },
        series: [
        {
            name: trans({ key: 'Sets' }),
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