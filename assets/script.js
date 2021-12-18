var container = document.getElementById("container")

fetch('https://picsum.photos/v2/list')
    .then(res=>res.json())
    .then(data=>{
        var images = data
        images.forEach((item, index) => {
            var img = document.createElement('img')
            img.classList.add('frame')
            img.setAttribute('src', item.download_url)
            if(index === images.length - 1) {
                img.width('width', 150.0/item.height*item.width)
            }
            container.appendChild(img)
        })
    })