import { Component, OnInit } from '@angular/core';
import { ToastService } from '../service/toast.service';
import { LivroService } from './shared/livro.service';

@Component({
  selector: 'app-livro',
  templateUrl: './livro.component.html',
  styleUrls: ['./livro.component.css']
})
export class LivroComponent implements OnInit {
  itemList: any = [];
  autorList: any = [];
  assuntoList: any = [];
  carregando: boolean = false;
  form: any = {
    Codl: null,
    Titulo: null,
    Editora: null,
    Edicao: null,
    AnoPublicacao: null,
    Autor_CodAu: [],
    Assunto_CodAs: 0
  };
  txtAddUpdate: string = '';
  idDel: number = 0;

  constructor(
    private httpProvider : LivroService,
    public toastService: ToastService
  ) { }

  ngOnInit(): void {
    this.getAll();
    //this.getAllAutor();
    this.getAllAssunto();
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
  async getAllAutor() {
    this.carregando = true;
    this.httpProvider.readAutor()
        .subscribe(res => {
          if (res != null && res.body.data != null) {
            this.autorList = res.body.data as [];
            this.carregando = false;
          }
        });
  }
  async getAllAssunto() {
    this.carregando = true;
    this.httpProvider.readAssunto()
        .subscribe(res => {
          if (res != null && res.body.data != null) {
            this.assuntoList = res.body.data as [];
            this.carregando = false;
          }
        });
  }

  removeToast(index: number) {
    this.toastService.remove(index);
  }

  selectAddUpdate(type: string) {
    this.form = {
      Codl: null,
      Titulo: null,
      Editora: null,
      Edicao: null,
      AnoPublicacao: null,
      Autor_CodAu: [],
      Assunto_CodAs: null
    };

    if(type === 'add') {
      this.getAllAutor();
      this.txtAddUpdate = 'Adicionar'
    } else {
      this.txtAddUpdate = 'Alterar'
    }
  }

  onCreateUpdate() {
    if (!this.form.Titulo && !this.form.Editora && !this.form.Edicao && !this.form.AnoPublicacao) {
      this.toastService.add('Preencha os campos obrigatório(s)', 3000, 'error');
      return false;
    }

    this.carregando = true;

    this.form.Autor_CodAu = this.getSelec

    if (!this.form.Codl) {
      // create
      this.httpProvider.create(this.form).subscribe((response) => {
        if (response) {
          this.toastService.add("Dados salvos com sucesso!", 3000, 'success');
          this.getAll();
        }
      });
    } else {
      //update
      this.httpProvider.update(this.form, this.form.Codl).subscribe((response) => {
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
            let data = res.body.data
            this.form = {...data};
            this.autorList = data.autor;
            this.form.Assunto_CodAs = data.assunto[0].CodAs;
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

  get autoresFilter() {
      return this.autorList.filter((item: any) => item.checked)
                           .map((item: any) => item);
  }

  get getSelec() {
    return this.autoresFilter.filter((item: any) => item.checked)
                             .map((item: any) => {
                              return this.txtAddUpdate === 'Adicionar' ? item.CodAu : item.Autor_CodAu
                             });
  }
}
