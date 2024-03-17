const form = $("#form");
const newsContainer = $("#news-container");

const viewNews = () => {
  newsContainer.html("");
  $.ajax({
    url: "http://localhost/news-website/backend/getnews.php",
    method: "GET",
    success: function (data) {
      resultArray = data.news;
      $.each(resultArray, function (index, article) {
        newsContainer.append(displayNews(article));
      });
    },
  });
};
viewNews();

const displayNews = (article) => {
  return `  <div class="child flex row">
          <div>${article.author}</div>
          <div>${article.title}</div>
          <div>${article.content}</div>
          </div>`;
};

form.submit(() => {
  let formdata = $(form).serialize();
  $.ajax({
    url: "http://localhost/news-website/backend/addnews.php",
    method: "POST",
    data: formdata,
  });
});
