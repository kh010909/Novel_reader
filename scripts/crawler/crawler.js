//預備做顯示後台運作進度
// const czbooksApp = Vue.createApp({
//     data() {
//         return {
//             pageURL: '',
//             isLoading: false,
//             status: ''
//         };
//     },
//     methods: {
//         startCrawler() {
//             this.isLoading = true;

//             fetch('./crawler/crawler_handle.php', {
//                 method: 'POST',
//                 headers: {
//                     'Content-Type': 'application/x-www-form-urlencoded'
//                 },
//                 body: new URLSearchParams({
//                     wb_name: this.wb_name,
//                     pageURL: this.pageURL
//                 })
//             })
//                 .then(response => response.json())
//                 .then(data => {
//                     this.isLoading = false;

//                     if (data.status === 'running') {
//                         this.status = '後臺正在運行...';
//                     } else if (data.status === 'finished') {
//                         this.status = '後臺處理完成';
//                     }
//                 })
//                 .catch(error => {
//                     console.error('請求失敗:', error);
//                     this.isLoading = false;
//                 });
//         }
//     }
// });

// czbooksApp.mount('#czbooks-block');

// 目前問題是crawler_handle.php回傳回來的資料是html不是json，可能是因為php 裡的readfile($docxFilePath)，
//      建議在服务器端将文件保存到临时目录中，而不是直接输出文件内容。然后，将文件的临时路径作为 JSON 数据的一部分返回给客户端。
//      客户端可以根据返回的文件路径进行下载操作。
// qidianApp.mount('#qidian-block');
// jjwxcApp.mount('#jjwxc-block');
