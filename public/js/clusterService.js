import { HTTP_STATUS } from './constants.js'

export const getClusterByWorkout = async (workoutId) => {
    try {
        const response = await fetch(`/api/clusters/${workoutId}`)
        const data = await response.json()
        return data
    } catch (error) {
        throw new Error(error.message)
    }
}

export const createCluster = async ({ workout_id, excercise_id, sets, reps, weight }) => {
    try {
        const requestOptions = {
            method: 'POST',
            body: JSON.stringify({ workout_id, excercise_id, sets, reps, weight }),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
        }

        const response = await fetch(`/api/clusters`, requestOptions)
        const data = await response.json()
        if (response.status !== HTTP_STATUS.OK) throw new Error(data.message)
        return { ...data, status: response.status }
    } catch (error) {
        throw new Error(error.message)
    }
}

export const deleteCluster = async (clusterId) => {
    try {
        const requestOptions = {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
        }

        const response = await fetch(`/api/clusters/${clusterId}`, requestOptions)
        const data = await response.json()
        if (response.status !== HTTP_STATUS.OK) throw new Error(data.message)
        return { ...data, status: response.status }
    } catch (error) {
        throw new Error(error.message)
    }
}

export const updateCluster = async ({ clusterId, props }) => {
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

        const response = await fetch(`/api/clusters/${clusterId}`, requestOptions)
        const data = await response.json()
        if (response.status !== HTTP_STATUS.OK) throw new Error(data.message)
        return { ...data, status: response.status }
    } catch (error) {
        throw new Error(error.message)
    }
}