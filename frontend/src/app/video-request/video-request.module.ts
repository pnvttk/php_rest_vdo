import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { VideoRequestGetComponent } from './video-request-get/video-request-get.component';



@NgModule({
  declarations: [
    VideoRequestGetComponent
  ],
  imports: [
    CommonModule
  ],
  exports: [VideoRequestGetComponent]
})
export class VideoRequestModule { }
