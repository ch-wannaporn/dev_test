var container = document.getElementById("container")

fetch('https://picsum.photos/v2/list')
    .then(res=>res.json())
    .then(data=>{
        var images = data
        images.forEach(item => {
            var img = document.createElement('img')
            img.classList.add('frame')
            img.setAttribute('src', item.download_url)
            container.appendChild(img)
        })
    })