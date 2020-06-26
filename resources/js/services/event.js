export default {
    create (data) {
        return axios({
            method: 'post',
            url: '/api/events',
            data: data
        });
    }
}