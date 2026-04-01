<?php

namespace App\Notifications;

use App\Models\Reply;
use App\Models\Topic;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TopicReplied extends Notification
{
    use Queueable;

    protected $reply;
    public function __construct(Reply $reply)
    {
        $this->reply = $reply;
    }
    /**
     * Create a new notification instance.
     *
     * @return void
     */

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        //return ['mail'];
        return ['database','mail'];
    }

    public function toDatabase($notifiable)
    {
        $topic = $this->reply->topic;
        $link = $topic->link(['#reply'.$this->reply->id]);
        return [
            'reply_id' => $this->reply->id,
            'reply_content' => $this->reply->content,
            'user_id' => $this->reply->user_id,
            'user_name' => $this->reply->user->name,
            'user_avatar' => $this->reply->user->avatar,
            'topic_link' => $link,
            'topic_id'=>$topic->id,
            'topic_title'=>$topic->title,
        ];
    }
    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = $this->reply->topic->link(['#reply'.$this->reply->id]);
        return (new MailMessage)
                    ->line('您的帖子有新的评论')
                    //->action('点击查看', url('/'))
                    ->action('点击查看',$url)
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
