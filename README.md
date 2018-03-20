ForkDelta API Wrapper
=====================
A very simple PHP wrapper for the ForkDelta API.

Using a token's symbol you can retrieve it's contract address, number of decimals, volume, last price, and so on. See below for the full command list.

Usage
-----
```
require_once 'ForkDelta.php';  
$api = new ForkDelta\Api();  
$api->printAddress('PAR');`
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

The ForkDelta API Wrapper is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

The ForkDelta API Wrapper is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with the ForkDelta API Wrapper. If not, see <http://www.gnu.org/licenses/>.
