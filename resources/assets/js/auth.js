export function login(credentials) {
    return new Promise((res, rej) => {
        axios.post('/api/login', {
            credentials
        }).then(response => {
            if(response.data.status == 'error') {
                handleError(rej);
            } else {
                res(response.data);
                console.log(response.data);
            }
        }).catch((err) => {
            handleError(rej);
        })
    });
}

export function getUser() {
    const user = localStorage.getItem("user");
    if(!user) {
        return null;
    }
    return JSON.parse(user);
}

function handleError(rej) {
    rej("Wrong email or password");
}


