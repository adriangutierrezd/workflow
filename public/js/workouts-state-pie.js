import { WORKOUT_STATUSES_COLORS, EMPTY_BOX_ICON } from './constants.js'
import { trans } from './utils.js';

window.addEventListener("DOMContentLoaded", () => {

    const chartContainer = document.getElementById('workouts-state-pie-container')
    const formattedData = Object.keys(workoutsByStatus).map(key => {
        return {
            value: workoutsByStatus[key].length,
            name: key,
            color: WORKOUT_STATUSES_COLORS[key]
        }
    })

    if (formattedData.length === 0) {

        const div = document.createElement('div')
        div.className = 'flex flex-col items-center justify-center h-full py-4'

        const iconSpan = document.createElement('span')
        iconSpan.innerHTML = EMPTY_BOX_ICON

        const noWksP = document.createElement('p')
        noWksP.innerText = trans({ key: 'Add some workouts to view statistics' })

        div.appendChild(iconSpan)
        div.appendChild(noWksP)

        chartContainer.innerHTML = ''
        chartContainer.appendChild(div)

        return
    }


    const chart = echarts.init(chartContainer)
    const labelColor = document.documentElement.classList.contains('dark') ? 'rgba(255, 255, 255, 0.5)' : 'rgba(60, 60, 60, 0.5)'

    chart.setOption({
        tooltip: {
            trigger: 'item'
        },
        legend: {
            bottom: '0%',
            left: 'center',
            textStyle: {
                color: labelColor,
                fontSize: 12
            }
        },
        series: [
            {
                type: "pie",
                data: formattedData,
                color: formattedData.map(data => data.color),
                label: {
                    color: labelColor,
                    fontSize: 12
                }
            },
        ],
        graph: {
            color: formattedData.map(data => data.color)
        }
    });
});
