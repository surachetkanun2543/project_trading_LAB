

$(document).ready(function () {
  let url =
    "https://newsapi.org/v2/everything?q=crypto&from=2022-10-01&to=2022-10-09&apiKey=b8f05f1231a04c0d922fc7b795116047";

  $.ajax({
    url: url,
    method: "GET",
    dataType: "JSON",

    beforeSend: function () {
      $(".progress").show();
    },

    complete: function () {
      $(".progress").hide();
    },

    success: function (newsdata) {
      let output = "";
      let latestNews = newsdata.articles;

      for (var i in latestNews) {
        // console.log(latestNews[i].media[0]["media-metadata"][2].url);
        // console.log("-------------------------------------------------------");   testing for finding the image src url
        // console.log(latestNews[i].media[0]);
        output += `

        <div class="col l3 m6 ">
        <div class="card medium hoverable">
             <div class="card-image">
               <img style="height: auto; width:auto;" src= "${latestNews[i].urlToImage}" class = "responsive-img"
  alt = "${latestNews[i].source}" >
             </div>
            <div class="card-content">
            <span class="card-title activator "></span>
            <h6 class="card-body"><a style="color:black;" href="${latestNews[i].url}" title="${latestNews[i].title}">${latestNews[i].title}</a></h5>
            <br>
            </div>
            <br>
            <div class="card-action">
              <a href="${latestNews[i].url}" target="_blank" class="btn">Read More</a>
            </div>
           </div>
          </div>
        `;
        // imgs = latestNews[i].media

      }
      console.log('lastnews : ', latestNews);

      if (output !== "") {
        $("#newsResults").html(output);
      }
    },

    error: function () {
      let errorMsg = `<div class="errorMsg center">Some error occured</div>`;
      $("#newsResults").html(errorMsg);
    },
  });
});