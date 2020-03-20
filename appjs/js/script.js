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

    fetch(urls[0])
    .then(pages => pages.json())
    .then(pages => {
        pages.forEach(item => {
            if (item.slug === 'home') {
                return dom[0].title.innerHTML = item.title.rendered;
            }
        })
    })
    .catch((e) => console.log(e))

    fetch(urls[1])
    .then(post => post.json())
    .then(post => {
        Object.keys(dom[1]).forEach(item => {
            console.log()
            if (item === 'image') {
                let image_url = post['acf'][`home_${item}`]['sizes']['medium'];
                return dom[1][item].src = image_url;
            }
            dom[1][item].innerHTML = post['acf'][`home_${item}`];
        });
    })
    .catch(() => {
        return dom[1].image.src = 'http://localhost:8080/wp-content/uploads/2019/11/fire-257x300.png';
    })
})
