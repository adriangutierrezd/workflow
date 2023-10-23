export const getWorkouts = async () => {
    try {
        const response = await fetch('/api/workouts')
        const data = await response.json()
        return data
    } catch (error) {
        throw new Error(error.message)
    }
}

export const deleteWorkout = async (id) => {

    try {
        const requestOptions = {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
        }

        const response = await fetch(`/api/workouts/${id}`, requestOptions)
        const data = await response.json()
        if (response.status !== 200) throw new Error(data.message)
        return { ...data, status: response.status }
    } catch (error) {
        throw new Error(error.message)
    }

}