/**
 * Fetches check-in data from the specified URL.
 *
 * @async
 * @function
 * @param {string} [url='/check-ins'] - The endpoint URL to fetch check-ins from.
 * @returns {Promise<any>} A promise that resolves to the data returned by the API.
 */
export async function getCheckIns(url = '/check-ins') {
    const response = await axios.get(url);
    return response.data;
}

/**
 * Sends a POST request to create a new check-in with the provided data.
 *
 * @async
 * @function
 * @param {FormData|Object} data - The check-in data to be sent. Should be a FormData object or an object compatible with multipart/form-data.
 * @returns {Promise<import('axios').AxiosResponse>} The Axios response from the server.
 */
export async function createCheckIn(data) {
    const response = await axios.post('/check-ins', data, {
        headers: {
            'Content-Type': 'multipart/form-data',
        },
    });
    return response;
}

/**
 * Deletes a check-in by its ID.
 *
 * Sends a DELETE request to the server to remove the specified check-in.
 *
 * @param {number|string} checkInId - The unique identifier of the check-in to delete.
 * @returns {Promise} A promise that resolves with the server response.
 */
export function deleteCheckIn(checkInId) {
    return axios.delete(`/check-ins/${checkInId}`);
}

/**
 * Updates a check-in with the specified data.
 *
 * @param {number|string} checkInId - The unique identifier of the check-in to update.
 * @param {Object} data - The data to update the check-in with. Should be compatible with multipart/form-data.
 * @returns {Promise} A Promise that resolves with the response of the update request.
 */
export function updateCheckIn(checkInId, data) {
    return axios.post(`/check-ins/${checkInId}`, data, {
        headers: {
            'Content-Type': 'multipart/form-data',
        },
    });
}

/**
 * Fetches check-in data by ID and populates the corresponding form fields with the retrieved values.
 *
 * @param {number|string} checkInId - The unique identifier of the check-in to view.
 * @returns {void}
 */
export async function viewCheckIn(checkInId) {
    const response = await axios.get(`/check-ins/${checkInId}`);
    const checkIn = response.data.data;
    document.querySelector('#description').value = checkIn.description;
    document.querySelector('#lat').value = checkIn.lat;
    document.querySelector('#lng').value = checkIn.lng;
    document.querySelector('#notes').value = checkIn.notes;
    document.querySelector('#check-in-id').value = checkIn.id;
    document.querySelector('.submit-check-in').textContent = 'Update';
    document.querySelector('#_method').value = 'PUT'; // Set method to PUT for update
};
