<?php
namespace backend\models;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Goods extends ActiveRecord{
    static public $is_on_sale=['0'=>'下架','1'=>'在售'];
    static public $status=['0'=>'回收站','1'=>'正常'];
    public $imgFile;
    public function rules()
    {
        return [
            [['name','sort', 'market_price','shop_price'], 'required'],
            [['brand_id','is_on_sale','status','stock','goods_category_id'], 'integer'],
            //[['logo'], 'string', 'max' => 255],
            ['imgFile','file','extensions'=>['jpg','png','gif']],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id'=>'ID',
            'name' => '商品名称',
            'sn'=>'货号',
            'logo'=>'LOGO图片',
            'goods_category_id'=>'商品分类id',
            'brand_id'=>'品牌分类',
            'market_price'=>'市场价格',
            'shop_price'=>'商品价格',
            'stock'=>'商品库存',
            'is_on_sale'=>'是否在售',
            'status'=>'状态',
            'sort'=>'排序',
        ];
    }
    public static function getBrandOptions(){
        return ArrayHelper::map(Brand::find()->all(),'id','name');
    }
    public function getGoodsCategory(){
        return $this->hasOne(GoodsCategory::className(),['id'=>'goods_category_id']);
    }
    public function getBrand(){
        return $this->hasOne(Brand::className(),['id'=>'brand_id']);
    }
}