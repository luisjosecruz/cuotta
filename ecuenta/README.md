# cuotta-bill
Creating bills, barcodes, QR codes and print data.

# index Ayeo

```
//for dev purposes
//fire this in browser to get the code image
use Ayeo\Barcode;
require_once('vendor/autoload.php');
$builder = new Barcode\Builder();
$builder->setBarcodeType('gs1-128');
$builder->setFilename('bar.png');
$builder->setImageFormat('png');
// $builder->setWidth(700);
$builder->setHeight(75);
//$builder->setFontPath('FreeSans.ttf');
$builder->setFontSize(15);
$builder->setBackgroundColor(255, 255, 255);
$builder->setPaintColor(0,0,0);
$builder->output('41574197000082933902000000400096202105118020100112000001');
/*(415)7419700008293(3902)0000066689(96)20210303(8020)100112000001
$builder->output('41574197000082933902000006668996202103038020100112000001');
$builder->saveImage('41574197000082933902000006668996202103038020100112000001');
$builder->output('41574197000082933902000000800096202105118020100112000002');
$builder->output('41574197000082933902000000400096202105118020100112000001'); */ 
```


