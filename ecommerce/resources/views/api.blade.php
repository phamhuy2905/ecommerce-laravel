<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Day la trang test api</h1>
    <div class="div">
        <ul class="list">

        </ul>
    </div>


    <form method="POST">
        <label for="">Name</label>
        <input type="text" name="name" class="name">
        <br>
        <label for="">Age</label>
        <input type="text" name="age" class="age">
        <br>
        <button class="btn">Submit</button>
    </form>
</body>

<script>
    const name = document.querySelector('.name');
    const age = document.querySelector('.age');
    const btn = document.querySelector('.btn');

    const link = "{{ route('api.index') }}";
    function test(callback) {
        fetch(link)
            .then(response=> {
                return response.json();
            })
            .then(callback)
    }

    function start() {
        test(render);
    }

    function render(data) {
        const api = data.data;
        const htmls = api.map(value => {
            return `
                <li>
                    ${value.name}
                </li>
                <p> ${value.role}</p>
            `
        })
        document.querySelector('.list').innerHTML = htmls.join('');
    }

    function postData(url = '', data = {}) {
        const option = {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {
                'Content-Type': 'application/json'
            },
        }
        fetch(link, option)
            .then(response=> {
                return response.json();
            })
            .then(response => {
                console.log(response);
            })
    }
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        const name_value = name.value;
        const age_value = age.value;
        console.log(name_value, age_value);
        const data = {
            name_value,
            age_value,
        }
        postData(link, data)
    })
    start();
</script>
</html>