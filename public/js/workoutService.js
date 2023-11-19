import { HTTP_STATUS } from './constants.js'

export const getWorkouts = async ({ startDate, endDate }) => {
    try {

        let url = '/api/workouts'
        if (startDate !== undefined) url = `${url}/${startDate}`
        if (endDate !== undefined) url = `${url}/${endDate}`

        const response = await fetch(url)
        const data = await response.json()
        return data
    } catch (error) {
        throw new Error(error.message)
    }
}

export const deleteWorkout = async (workoutId) => {

    try {
        const requestOptions = {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
        }

        const response = await fetch(`/api/workouts/${workoutId}`, requestOptions)
        const data = await response.json()
        if (response.status !== HTTP_STATUS.OK) throw new Error(data.message)
        return { ...data, status: response.status }
    } catch (error) {
        throw new Error(error.message)
    }

}

export const updateWorkout = async ({ workoutId, props }) => {
    try {
        const requestOptions = {
            method: 'PUT',
            body: JSON.stringify(props),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
        }

        const response = await fetch(`/api/workouts/${workoutId}`, requestOptions)
        const data = await response.json()
        if (response.status !== HTTP_STATUS.OK) throw new Error(data.message)
        return { ...data, status: response.status }
    } catch (error) {
        throw new Error(error.message)
    }
}