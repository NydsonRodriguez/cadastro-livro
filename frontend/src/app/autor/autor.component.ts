import { Component, OnInit } from '@angular/core';
import { ToastService } from '../service/toast.service';
import { AutorService } from './shared/autor.service';

@Component({
  selector: 'app-autor',
  templateUrl: './autor.component.html',
  styleUrls: ['./autor.component.css']
})
export class AutorComponent implements OnInit {
  itemList: any = [];
  carregando: boolean = false;
  form: any = {
    CodAu: null,
    Nome: null
  };
  txtAddUpdate: string = '';
  idDel: number = 0;

  constructor(
    private httpProvider : AutorService,
    public toastService: ToastService
  ) { }

  ngOnInit(): void {
    this.getAll();
  }

  async getAll() {
    this.carregando = true;
    this.httpProvider.read()
        .subscribe(res => {
          if (res != null && res.body.data != null) {
            this.itemList = res.body.data as [];
            this.carregando = false;
          }
        });
  }

  removeToast(index: number) {
    this.toastService.remove(index);
  }

  selectAddUpdate(type: string) {
    this.form = {
      CodAu: null,
      Nome: null
    };

    if(type === 'add') {
      this.txtAddUpdate = 'Adicionar'
    } else {
      this.txtAddUpdate = 'Alterar'
    }
  }

  onCreateUpdate() {
    if (!this.form.Nome) {
      this.toastService.add('Preencha os campos obrigatório(s)', 3000, 'error');
      return false;
    }

    this.carregando = true;

    if (!this.form.CodAu) {
      // create
      this.httpProvider.create(this.form).subscribe((response) => {
        if (response) {
          this.toastService.add("Dados salvos com sucesso!", 3000, 'success');
          this.getAll();
        }
      });
    } else {
      //update
      this.httpProvider.update(this.form, this.form.CodAu).subscribe((response) => {
        if (response) {
          this.toastService.add("Dados alterados com sucesso!", 3000, 'success');
          this.getAll();
        }
      });
    }

    return
  }

  onEdit(id: number) {
    if (id) {
      this.carregando = true;
      this.httpProvider.edit(id)
        .subscribe(res => {
          if (res != null && res.body.data != null) {
            this.form = {...res.body.data};
            this.carregando = false;
          }
        });
    }
  }

  onDelete(id: number) {
    this.idDel = id;
  }

  onSubmitDelete() {
    if (this.idDel) {
      this.carregando = true;
      this.httpProvider.delete(this.idDel).subscribe((response) => {
        if (response) {
          this.toastService.add("Dados deletados com sucesso!", 3000, 'success');
          this.getAll();
        }
      });
    }
  }
}
