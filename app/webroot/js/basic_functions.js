Object.size = function(obj)
{
    var size = 0, key;
    for (key in obj) {
        if (obj.hasOwnProperty(key))
            size++;
    }
    return size;
};

String.replaceAll = function(search, replace, str)
{
    return str.replace(new RegExp(search, 'g'), replace);
};

String.contains = function(str, sub)
{
    return str.indexOf(sub) >= 0;
};

String.containsBetween = function(str, start_cap, end_cap)
{
    var arr = [];

    while (str.length > 0)
    {
        var s_ind = str.indexOf(start_cap);
        var e_ind = str.indexOf(end_cap);
        if (s_ind >= 0 && e_ind >= 0)
        {
            var sub = str.substr(s_ind, (e_ind - s_ind + 1));
            arr.push(sub.replace(start_cap, "").replace(end_cap, ""));
            str = str.replace(sub, "");
        }
        else
        {
            return arr;
        }
    }

    return arr;
};

String.toTitleCase = function(str) 
{
    return str.replace(/(?:^|\s)\w/g, function(match) {
        return match.toUpperCase();
    });
}

function toDataUrl(src, outputFormat, callback)
{
    var img = new Image();
    img.crossOrigin = 'Anonymous';
    img.onload = function() {
        var canvas = document.createElement('CANVAS');
        canvas.height = this.height;
        canvas.width = this.width;

        var ctx = canvas.getContext('2d');
        ctx.webkitImageSmoothingEnabled = true;
        ctx.mozImageSmoothingEnabled = true;
        ctx.imageSmoothingEnabled = true;
        ctx.imageSmoothingQuality = "high";

        ctx.drawImage(this, 0, 0);
        var dataURL = canvas.toDataURL(outputFormat, 1.0);
        callback(src, dataURL);
    };
    img.src = src;
    if (img.complete || img.complete === undefined) {
        img.src = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";
        img.src = src;
    }
}

function wait(time, callback, onStopCallback)
{
    var inverval_wait = setInterval(function()
    {
        callback(time);
        time -= 1;

        if (time < 0)
        {
            clearInterval(inverval_wait);
            onStopCallback();
        }
    }, 1000);

    callback(time);
}

function download_csv(csv, filename) {
    var csvFile;
    var downloadLink;

    // CSV FILE
    csvFile = new Blob([csv], {type: "text/csv"});

    // Download link
    downloadLink = document.createElement("a");

    // File name
    downloadLink.download = filename + ".csv";

    // We have to create a link to the file
    downloadLink.href = window.URL.createObjectURL(csvFile);

    // Make sure that the link is not displayed
    downloadLink.style.display = "none";

    // Add the link to your DOM
    document.body.appendChild(downloadLink);

    // Lanzamos
    downloadLink.click();
}

function table_to_csv(table, filename, rows) 
{
    var csv = [];

    var ths = table.find(">thead > tr > th, >thead > tr > td");
        
    if (typeof rows == "undefined")
    {
        rows = table.find(">tbody > tr").not(".csv-export-not-include");
    }
    
    var cols = {};
    var row = [];
    
    for (var j = 0; j < ths.length; j++)
    {
        var _is = $(ths[j]).attr("data-csv");
        
        if (typeof _is == "undefined")
        {
            _is = true;
        }
        else
        {
            _is = _is == "1";
        }
        
        if (_is)
        {
            cols[j] = $(ths[j]);
            row.push('"' + cols[j].text().trim() + '"');
        }
        else
        {
            cols[j] = 0;
        }
    }
    
    console.log(cols);
    
    csv.push(row.join(","));

    for (var i = 0; i < rows.length; i++) 
    {
        var row = [];

        var tds = $(rows[i]).find("> td");
        for (var j = 0; j < tds.length; j++)
        {
            if (cols[j] != 0)
            {
                row.push('"' + $(tds[j]).text().trim() + '"'); 
            }            
        }

        csv.push(row.join(","));
    }

    // Download CSV
    download_csv(csv.join("\n"), filename);
}

function csv2array(strData, strDelimiter) {
    strDelimiter = (strDelimiter || ",");
    var objPattern = new RegExp((
    // Delimiters.
    "(\\" + strDelimiter + "|\\r?\\n|\\r|^)" +
    // Quoted fields.
    "(?:\"([^\"]*(?:\"\"[^\"]*)*)\"|" +
    // Standard fields.
    "([^\"\\" + strDelimiter + "\\r\\n]*))"), "gi");
    // Create an array to hold our data. Give the array
    // a default empty first row.
    var arrData = [[]];
    // Create an array to hold our individual pattern
    // matching groups.
    var arrMatches = null;
    // Keep looping over the regular expression matches
    // until we can no longer find a match.
    while (arrMatches = objPattern.exec(strData)) {
        // Get the delimiter that was found.
        var strMatchedDelimiter = arrMatches[1];
        // Check to see if the given delimiter has a length
        // (is not the start of string) and if it matches
        // field delimiter. If id does not, then we know
        // that this delimiter is a row delimiter.
        if (strMatchedDelimiter.length && (strMatchedDelimiter != strDelimiter)) {
            // Since we have reached a new row of data,
            // add an empty row to our data array.
            arrData.push([]);
        }
        // Now that we have our delimiter out of the way,
        // let's check to see which kind of value we
        // captured (quoted or unquoted).
        if (arrMatches[2]) {
            // We found a quoted value. When we capture
            // this value, unescape any double quotes.
            var strMatchedValue = arrMatches[2].replace(
            new RegExp("\"\"", "g"), "\"");
        } else {
            // We found a non-quoted value.
            var strMatchedValue = arrMatches[3];
        }
        // Now that we have our value string, let's add
        // it to the data array.
        arrData[arrData.length - 1].push(strMatchedValue);
    }
    // Return the parsed data.
    return (arrData);
}

function csv2json(csv) {
    var array = csv2array(csv);
    var objArray = [];
    for (var i = 1; i < array.length; i++) {
        objArray[i - 1] = {};
        for (var k = 0; k < array[0].length && k < array[i].length; k++) {
            var key = array[0][k];
            objArray[i - 1][key] = array[i][k]
        }
    }

    var json = JSON.stringify(objArray);
    var str = json.replace(/},/g, "},\r\n");

    return str;
}

function csvArray2csvheader(data)
{
    var records = [], headers = [];
                
    for(var i in data)
    {
        var arr = data[i];
        if (i == 0)
        {
            for(var a in arr)
            {
                headers.push(arr[a]);
            }
        }
        else
        {
            var record = {};
            for(var a in arr)
            {
                record[headers[a]] = arr[a];
            }

            records.push(record);
        }
    }
    
    return records;
}

function niceBytes(bytes, i)
{
    var list = ["B", "KB", "MB", "GB", "TB"];

    if (typeof i == "undefined")
    {
        i = 0;
    }

    var temp  = bytes / 1024;

    if (temp > 1024)
    {
        return niceBytes(temp, i + 1);
    }

    if (temp < 1)
    {
        return bytes.toFixed(1) + " " + list[i];
    }
    else
    {
        return temp.toFixed(1) + " " + list[i + 1];
    }
}

function get_web_api_request()
{
    var raw_request = window.localStorage.getItem("default_web_api_request");
                
    if (raw_request === null)
    {
        bootbox.alert("Default Web Api Request not found. Please Re-login");
        return;
    }

    try
    {
        var request = JSON.parse(raw_request);
    }
    catch(e)
    {
        console.error("can not parse default_web_api_request");
        return;
    }
    
    return request;
}