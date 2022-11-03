//Pseudo code
//Step 1: Define chart properties.
//Step 2: Create the chart with defined properties and bind it to the DOM element.
//Step 3: Add the CandleStick Series.
//Step 4: Set the data and render.
//Step5 : Plug the socket to the chart


//Code
// const log = console.log;

const chartProperties = {
  width:1000,
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
    text: "BTC/USDT 30M",
    fontSize: 40,
    color: "rgba(256, 256, 256, 0.1)",
    visible: true
  }
}

const domElement = document.getElementById('tvchart');
const chart = LightweightCharts.createChart(domElement,chartProperties);
const candleSeries = chart.addCandlestickSeries();
const volumeSeries = chart.addHistogramSeries();


fetch(`https://api.binance.com/api/v3/klines?symbol=BTCUSDT&interval=30m&limit=1000`)
  .then(res => res.json())
  .then(data => {
    const cdata = data.map(d => {
      return {time:d[0]/1000,open:parseFloat(d[1]),high:parseFloat(d[2]),low:parseFloat(d[3]),close:parseFloat(d[4])}
    });
    candleSeries.setData(cdata);
    // volumeSeries.setData(cdata);
  })
  .catch(err => log(err))

