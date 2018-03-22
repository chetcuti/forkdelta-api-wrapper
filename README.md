ForkDelta API Wrapper
=====================
A very simple PHP wrapper for the ForkDelta API.

Using a token's symbol you can retrieve its contract address, number of decimal places, volume, last price, and so on. See below for the full command list.

Usage
-----
```
require_once 'ForkDelta.php';  
$api = new ForkDelta\Api();
 
$api->printAddress('PAR');
```

Prints PAR's Contract Address:  
0x1beef31946fbbb40b877a72e4ae04a8d1a5cee06

Command List
------------
printAddress    
printDecimals  
printQuoteVolume  
printBaseVolume  
printLastPrice  
printBidPrice  
printAskPrice  
printUpdated

Support
-------
If you need any help feel free to email me at greg@chetcuti.com.

Changelog
---------
Please see the CHANGELOG file.

External Resources
------------------
ForkDelta Decentralized Ethereum Token Exchange - <https://forkdelta.github.io>

License
-------
Copyright (c) 2018 Greg Chetcuti <greg@chetcuti.com>

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
