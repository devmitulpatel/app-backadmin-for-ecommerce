<?php
namespace App\Helper\HelperClass\Img;
use Intervention\Image\ImageManager;

class Doit{

    private $template,$photoUrl,$userData,$templateData,$templateCalculatedData,$rawImg,$templateImg;

    public function __construct($template,$photoUrl,$userData)
    {
        $this->template=$template;
        $this->photoUrl=$photoUrl;
        $this->userData=$userData;
        $this->templateData=$this->getTamplateData($this->template);
    }

    public function make(){

        $templateData=$this->templateData;


        $manager = new ImageManager(array('driver' => 'gd'));

        $baseImg=$manager->canvas(1440,1440);

        $templateImg=$manager->make($templateData['path']);

        $photoImg=$manager->make($this->photoUrl);


        $this->templateCalculatedData=[

            'template'=>[
                'w'=>$templateImg->width(),
                'h'=>$templateImg->height(),
            ],

            'photo'=>[
                'w'=>$photoImg->width(),
                'h'=>$photoImg->height(),
            ]
        ];


        foreach($templateData['photo'] as $p){
            if(array_key_exists('w',$p)&&array_key_exists('h',$p))$photoImg->resize($p['w'],$p['h']);
            if(array_key_exists('align',$p)&&(array_key_exists('left',$p)||array_key_exists('right',$p)))$templateImg->insert($photoImg,$p['align'],$p['top'],$p['left']);
        }

        foreach($templateData['text'] as $k=>$t){
            if(array_key_exists($k,$this->userData)){

                   $side=$t['left']?? $t['right'];

                   if(array_key_exists('type',$t) && $t['type'] =='dynamic'){
                    $side=str_replace('tw',$this->templateCalculatedData['template']['w'],$side);

                    $side=eval(implode(' ' ,['return '.$side,';' ]));
                    $t['top']=str_replace('th',$this->templateCalculatedData['template']['h'],$t['top']);

                    $t['top']=eval(implode(' ' ,['return '.$t['top'],';' ]));

                }

            $templateImg->text($this->userData[$k],$side,$t['top'],function ($f)use($t){
                if(array_key_exists('font',$t))$f->file($t['font']);
                if(array_key_exists('size',$t))$f->size($t['size']);
                if(array_key_exists('color',$t))$f->color($t['color']);
                if(array_key_exists('align',$t))$f->align($t['align']);
                if(array_key_exists('valign',$t))$f->valign($t['valign']);
            });


            }

        }

        $this->rawImg=$templateImg->stream('jpg', 100);
        $this->templateImg=$templateImg;
        return $this;
        dd($this);
        header ('Content-Type: image/png');
        return $templateImg->response();
    }


    public  function save($path,$filename){
                $path=implode(DS,[$path,$filename]);
                return $this->templateImg->save($path,100);
    }
    private function getTamplateData($k):array{

        $allTemplate=[
            '1'=>[

                'path'=>storage_path(implode(DS,['lvp','upload','sample','b.png'])),
            'photo'=>[
                        [
                            'left'=>42,
                            'top'=>42,
                            'align'=>'top-left',
                            'w'=>145,
                            'h'=>156
                        ]
                      ],
                'text'=>[
                    'name'=>[
                        'left'=>58,
                        'top'=>227,
                        'align'=>'left',
                        'size'=>'18',
                        'color'=>'rgba(0,0,0,0.8)',
                        'valign'=>'center',
                        'font'=>storage_path(implode(DS,['lvp','upload','sample','3.ttf']))
                    ],
                    'number'=>[
                        'left'=>55,
                        'top'=>253,
                        'align'=>'left',
                        'size'=>'18',
                        'color'=>'rgba(0,0,0,0.8)',
                        'valign'=>'center',
                        'font'=>storage_path(implode(DS,['lvp','upload','sample','3.ttf']))
                        ],
                    'from'=>[
                        'type'=>'dynamic',
                        'left'=>'tw/2',
                        'top'=>'th-20',
                        'align'=>'center',
                        'size'=>'18',
                        'color'=>'rgba(0,0,0,0.8)',
                        'valign'=>'bottom',
                        'font'=>storage_path(implode(DS,['lvp','upload','sample','3.ttf']))
                        ],
                ]
            ],
        ];
        return (array_key_exists($k,$allTemplate))?$allTemplate[$k]:reset($allTemplate);

    }




}
