var fetchModule = (function() {
    let url = 'http://localhost:8080/wp-json/acf/v3/pages/19/';
    let img = document.getElementsByTagName('img')[0];
    (async function fetchUrl() {
        const resp = await fetch(url);
        const data = await resp.json();
        return data;
    })()
    .then(function(data) {
        img.src = data['acf']['image']['url'];
    })
    .catch(function() {
        img.src = 'https://a.slack-edge.com/80588/img/services/jenkins-ci_512.png';
    })
})
