var fetchPostModule = (() => {
    const url = 'http://localhost:8080/wp-json/acf/v3/pages/19/';
    const dom = {
        title: document.getElementsByTagName('h1')[0],
        subtitle: document.getElementsByTagName('h2')[0],
        text: document.getElementsByTagName('p')[0],
        image: document.getElementsByTagName('img')[0]
    };
    (async function fetchUrl() {
        const resp = await fetch(url);
        const post = await resp.json();
        return post;
    })()
    .then(post => {
        console.log(post);
        Object.keys(dom).forEach(item => {
            if (item === 'image') {
                let image_url = post['acf'][`home_${item}`]['sizes']['medium'];
                return dom[item].src = image_url;
            }
            dom[item].innerHTML = post['acf'][`home_${item}`];
        });
    })
    .catch(e => {
        console.log(e);
        return dom.image.src = 'http://localhost:8080/wp-content/uploads/2019/11/fire-257x300.png';
    })
})
