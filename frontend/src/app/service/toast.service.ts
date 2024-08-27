// toast.service.ts
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root',
})

export class ToastService {

  toasts: { message: string; duration: number; type: string }[] = [];

  add(message: string, duration: number = 3000, type: string) {
    this.toasts.push({ message, duration, type });
    setTimeout(() => this.remove(0), duration);
  }

  remove(index: number) {
    this.toasts.splice(index, 1);
  }
}
