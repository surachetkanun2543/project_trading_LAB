//Pseudo code
//Step 1: Define chart properties.
//Step 2: Create the chart with defined properties and bind it to the DOM element.
//Step 3: Add the CandleStick Series.
//Step 4: Set the data and render.
//Step5 : Plug the socket to the chart


//Code
// const log = console.log;

const chartProperties = {
  width:1500,
  height:600,
  timeScale:{
    timeVisible:true,
    secondsVisible:false,
  },
  layout: {
    backgroundColor: "#253248",
    textColor: "#d1d4dc"
  },
  grid: {
    vertLines: {
      color: "#334158"
    },
    horzLines: {
      color: "#334158"
    }
  },
  priceScale: {
    borderColor: "#F8F9FA"
  },
  timeScale: {
    borderColor: "#F8F9FA"
  },
  watermark: {
    text: "GOLD/USDT 4H",
    fontSize: 80,
    color: "rgba(256, 256, 256, 0.1)",
    visible: true
  }
}

const domElement = document.getElementById('tvchartxau');
const chart = LightweightCharts.createChart(domElement,chartProperties);
const candleSeries = chart.addCandlestickSeries();
const volumeSeries = chart.addHistogramSeries();


fetch(`https://api.binance.com/api/v3/klines?symbol=PAXGUSDT&interval=4h&limit=500`)
  .then(res => res.json())
  .then(data => {
    const cdata = data.map(d => {
      return {time:d[0]/500,open:parseFloat(d[1]),high:parseFloat(d[2]),low:parseFloat(d[3]),close:parseFloat(d[4])}
    });
    candleSeries.setData(cdata);
    // volumeSeries.setData(cdata);
  })
  .catch(err => log(err))
