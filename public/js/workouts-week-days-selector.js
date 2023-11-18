import { EMPTY_BOX_ICON, EXTERNAL_LINK_ICON } from './constants.js'

window.addEventListener('DOMContentLoaded', () => {
    
    const weekDaySelectors = Array.from(document.querySelectorAll('.week-day-selector'))
    const selectedDate = weekDaySelectors.find(selector => selector.classList.contains('week-day-active'))
    
    const clearSelectedDay = () => {
        weekDaySelectors.forEach(selector => {
            selector.classList.remove('week-day-active')
            if(selector.hasAttribute('aria-current')){
                selector.removeAttribute('aria-current')
            }
            selector.classList.add('week-day-default')
        })
    }

    const selectDay = (element) => {
        element.classList.remove('week-day-default')
        element.classList.add('week-day-active')
        element.setAttribute('aria-current', 'page')        
    }
    

    const loadDayData = (date) => {
        const workouts = workoutsByWeek[date] ?? []
        const container = document.getElementById('workouts-by-date-container')

        if(workouts.length === 0){

            container.classList.remove('justify-start')
            container.classList.add('justify-center')

            const div = document.createElement('div')
            div.className = 'flex flex-col items-center justify-center'

            const iconSpan = document.createElement('span')
            iconSpan.innerHTML = EMPTY_BOX_ICON

            const noWksP = document.createElement('p')
            noWksP.innerText = 'Aún no tienes ningún entrenamiento este día'

            div.appendChild(iconSpan)
            div.appendChild(noWksP)
            
            container.innerHTML = ''
            container.appendChild(div)

        }else{
            container.classList.add('justify-start')
            container.classList.remove('justify-center')
            container.innerHTML = ''
            workouts.forEach(workout => {
                
                const { id, title, user } = workout

                const workoutDiv = document.createElement('div')
                workoutDiv.className = 'flex items-center justify-between border-l-4 border-blue-600 p-2 mt-3'
    
                const infoDiv = document.createElement('div')
                const workoutTitle = document.createElement('h3')
                workoutTitle.className = 'text-md font-medium text-gray-800 dark:text-white'
                workoutTitle.innerText = title
    
                const userDiv = document.createElement('div')
                userDiv.className = 'flex items-center justify-start mt-2'
    
                const userPhoto = document.createElement('img')
                userPhoto.className = 'object-cover w-6 h-6 rounded-full'
                userPhoto.src = user.image_url
    
                const userName = document.createElement('span')
                userName.innerText = 'John Doe'
    
                userDiv.appendChild(userPhoto)
                userDiv.appendChild(userName)
    
                infoDiv.appendChild(workoutTitle)
                infoDiv.appendChild(userDiv)
    
                const link = document.createElement('a')
                link.href = '#'
                link.innerHTML = EXTERNAL_LINK_ICON
                link.className = 'hover:text-blue-600'
                link.title = 'Ver entrenamiento'
    
                workoutDiv.appendChild(infoDiv)
                workoutDiv.appendChild(link)
    
                container.appendChild(workoutDiv)


            })



        }

    }

    weekDaySelectors.forEach(selector => {
        selector.addEventListener('click', ({ target }) => {
            clearSelectedDay()
            const actualElement = target.localName === 'li' ? target : target.parentElement
            selectDay(actualElement)
            loadDayData(actualElement.dataset.date)

        })
    })

    loadDayData(selectedDate.dataset.date)

})