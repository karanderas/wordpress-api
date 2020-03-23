var fetchHomeModule = (() => {
    const domain = 'http://localhost:8080/';
    const urls = [domain + 'wp-json/wp/v2/pages', domain + 'wp-json/acf/v3/pages/19'];
    const dom = [
        {
            title: document.getElementsByTagName('h1')[0],
        },
        {
            subtitle: document.getElementsByTagName('h2')[0],
            text: document.getElementsByTagName('p')[0],
            image: document.getElementsByTagName('img')[0]
        }
    ];
    for (let i=0; i<urls.length;i++) {
        fetch(urls[i])
        .then(post => post.json())
        .then(post => {
            if (i===0) {
                post.forEach(item => {
                    if (item.slug === 'home') {
                        return dom[i].title.innerHTML = item.title.rendered;
                    }
                })

            }else{
                Object.keys(dom[i]).forEach(item => {
                    if (item === 'image') {
                        let image_url = post['acf'][`home_${item}`]['sizes']['medium'];
                        return dom[i][item].src = image_url;
                    }
                    dom[i][item].innerHTML = post['acf'][`home_${item}`];
                });
            }
        })
        .catch((error) => {
            console.log(error);
            return dom[i].image.src = 'http://localhost:8080/wp-content/uploads/2019/11/fire-257x300.png';
        });
    }
})
export {fetchHomeModule};