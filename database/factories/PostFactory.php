<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $titles = [
            'إضراب وطني شامل يوم الثلاثاء القادم',
            'اجتماع عاجل للمكتب الوطني للجامعة الحرة للتعليم',
            'بيان استنكاري حول الاقتطاعات غير المشروعة',
            'نجاح باهر للمؤتمر الجهوي بجهة الدار البيضاء سطات',
            'وزارة التربية الوطنية تصدر مذكرة جديدة حول الامتحانات',
            'وقفة احتجاجية أمام مقر الوزارة بالرباط',
            'تهنئة بمناسبة عيد الفطر المبارك',
            'بلاغ إخباري حول مخرجات الحوار القطاعي',
        ];

        $title = $this->faker->randomElement($titles);

        return [
            'category_id' => \App\Models\Category::inRandomOrder()->first()->id ?? \App\Models\Category::factory(),
            'title' => $title,
            'slug' => $this->faker->slug . '-' . $this->faker->unique()->numberBetween(1000, 9999),
            'content' => "أعلنت الجامعة الحرة للتعليم عن تنظيم إضراب وطني شامل احتجاجاً على تماطل الوزارة في تنفيذ الملف المطلبي...\n\n" . 
                         "وفي هذا السياق، أكد الكاتب العام للنقابة أن الوضع لم يعد يحتمل، وأن الشغيلة التعليمية مستعدة للتصعيد...\n\n" .
                         "وندعو كافة المناضلات والمناضلين إلى الالتفاف حول إطارهم العتيد للدفاع عن كرامة نساء ورجال التعليم.",
            'image' => 'https://placehold.co/600x400/png',
            'is_published' => true,
            'is_urgent' => $this->faker->boolean(20),
        ];
    }
}
