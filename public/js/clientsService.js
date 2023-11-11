import { HTTP_STATUS } from './constants.js'

export const getClients = async (trainerId) => {
    try {
        const response = await fetch(`/api/trainer/clients/${trainerId}`)
        const data = await response.json()
        if (response.status !== HTTP_STATUS.OK) throw new Error(data.message)
        return { ...data, status: response.status }
    } catch (error) {
        throw new Error(error.message)
    }
}

export const createClient = async ({ trainerId, client }) => {
    try {
        const requestOptions = {
            method: 'POST',
            body: JSON.stringify({ trainer_id: trainerId, user_id: client }),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
        }

        const response = await fetch(`/api/trainer/clients`, requestOptions)
        const data = await response.json()
        if (response.status !== HTTP_STATUS.CREATED) throw new Error(data.message)
        return { ...data, status: response.status }
    } catch (error) {
        throw new Error(error.message)
    }
}

export const deleteClient = async ({ clientTrainerId }) => {
    try {
        const requestOptions = {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
        }

        const response = await fetch(`/api/trainer/clients/${clientTrainerId}`, requestOptions)
        const data = await response.json()
        if (response.status !== HTTP_STATUS.OK) throw new Error(data.message)
        return { ...data, status: response.status }
    } catch (error) {
        throw new Error(error.message)
    }
}


export const getPossibleClients = async (search = null) => {
    try {
        const path = search ? `/api/trainer/possible-clients/${search}` : `/api/trainer/possible-clients`
        const response = await fetch(path)
        const data = await response.json()
        if (response.status !== HTTP_STATUS.OK) throw new Error(data.message)
        return { ...data, status: response.status }
    } catch (error) {
        throw new Error(error.message)
    }
}